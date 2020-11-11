<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi;

use Illuminate\Http\Request;
use MobiMarket\OneApi\Entities\BalanceResponse;
use MobiMarket\OneApi\Entities\CallbackRequest;
use MobiMarket\OneApi\Entities\Contact;
use MobiMarket\OneApi\Entities\HighlyStructuredMessage;
use MobiMarket\OneApi\Entities\Location;
use MobiMarket\OneApi\Entities\Media;
use MobiMarket\OneApi\Entities\MediaMetadataResponse;
use MobiMarket\OneApi\Entities\MessageRequest;
use MobiMarket\OneApi\Entities\MessageResponse;
use MobiMarket\OneApi\Entities\MessageStatusResponse;
use MobiMarket\OneApi\Entities\SingleMessageRequest;
use MobiMarket\OneApi\Entities\Template;
use MobiMarket\OneApi\Entities\TemplateBody;
use MobiMarket\OneApi\Entities\TemplateHeader;
use MobiMarket\OneApi\Entities\UploadMediaResponse;
use MobiMarket\OneApi\Exceptions\InvalidMessageRequest;
use MobiMarket\OneApi\Traits\RestApiClient;

class OneApiRestApi
{
    use RestApiClient;

    public function __construct(
        string $base_uri,
        float $timeout,
        bool $should_log,
        string $api_key
    ) {
        $this->buildClient(
            $base_uri,
            $timeout,
            $should_log,
            $api_key
        );
    }

    /*
     * POST /message
     */
    public function message(MessageRequest $request): MessageResponse
    {
        $response = $this->sendAPIRequest('post', 'message', $request->toArray());

        return new MessageResponse($response);
    }

    /*
     * GET /message/{fileId}
     */
    public function getMessageStatus(string $messageId): MessageStatusResponse
    {
        $response = $this->sendRawAPIRequest('get', "message/{$messageId}");

        return new MessageStatusResponse($response);
    }

    /*
     * POST /media
     */
    public function uploadMedia(string $to, string $fileName, string $contentType, string $contents): UploadMediaResponse
    {
        $response = $this->sendRawAPIRequest('post', 'media', $contents, [
            'Content-Type' => $contentType,
        ], [
            'to'               => $to,
            'fileName'         => $fileName,
            'sha256FileHash'   => \hash('sha256', $contents),
            'broadcastAllowed' => true,
        ]);

        return new UploadMediaResponse($response);
    }

    /*
     * GET /media
     *
     * returns ['content' => $binary]
     */
    public function downloadMedia(Media $media): array
    {
        return $this->sendRawAPIRequest('get', 'media', null, null, [
            'fileId'     => $media->fileId,
            'sha256Hash' => $media->sha256Hash,
            'source'     => 'client',
        ]);
    }

    /*
     * GET /media/{fileId}
     */
    public function getMediaMetadata(Media $media): MediaMetadataResponse
    {
        $response = $this->sendRawAPIRequest('get', "media/{$media->fileId}");

        return new MediaMetadataResponse($response);
    }

    /*
     * GET /balance
     */
    public function getBalance(): BalanceResponse
    {
        $response = $this->sendRawAPIRequest('get', 'balance');

        return new BalanceResponse($response);
    }

    /**
     * Safe process of all events, will never error but returns an array of its errors.
     */
    public function processEvents(Request $request, callable $callback): array
    {
        $processor = new CallbackRequest($request);

        // bruh
        if (null === $processor->events || $processor->events->isEmpty()) {
            return [];
        }

        $errors = [];
        foreach ($processor->events as $event) {
            try {
                $callback($processor, $event);
            } catch (\Throwable $t) {
                $errors[$event->messageId] = $t;
            }
        }

        return $errors;
    }

    /**
     * Simplified creation of messages.
     */
    public function createMessage(string $channel, string $to, array $data): SingleMessageRequest
    {
        $creationData = collect([
            'channel'               => $channel,

            'to'                    => $to,
            'from'                  => $data['from'] ?? null,
            'binary'                => $data['binary'] ?? false,
            'content'               => $data['content'] ?? null,
            'clientMessageId'       => $data['clientMessageId'] ?? null,

            'encryptionKey'         => $data['encryptionKey'] ?? null,
            'scheduledDeliveryTime' => $data['scheduledDeliveryTime'] ?? null,
            'validityPeriod'        => $data['validityPeriod'] ?? null,
            'previewFirstUrl'       => $data['previewFirstUrl'] ?? null,
            'userDataHeader'        => $data['userDataHeader'] ?? null,
        ])
            ->filter();

        $message = new SingleMessageRequest($creationData);

        // don't bother continuing
        if (false === $message->isValid()) {
            throw new InvalidMessageRequest($message);
        }

        $hsm = $data['hsm'] ?? false;
        if ($hsm) {
            $message->hsm = new HighlyStructuredMessage($hsm);
        }

        $template = $data['template'] ?? false;
        if ($template) {
            $message->template         = new Template(['templateName' => $template['templateName']]);
            $message->template->body   = new TemplateBody($template['body']);
            $message->template->header = new TemplateHeader($template['header']);
        }

        $location = $data['location'] ?? false;
        if ($location) {
            $message->location = new Location($location);
        }

        $contacts = $data['contacts'] ?? false;
        if ($contacts) {
            $message->contacts = collect($contacts)
                ->mapInto(Contact::class)
                ->toArray();
        }

        $media = $data['media'] ?? false;
        if ($media) {
            $message->media = new Media($media);
        }

        // sms' with whatsapp features, messages with nothing in them
        $contains = $message->content ?: $message->template ?: $message->media ?: $message->hsm;
        if (false === $message->isValid() || null === $contains) {
            throw new InvalidMessageRequest($message);
        }

        return $message;
    }
}
