<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi;

use MobiMarket\OneApi\Entities\BalanceResponse;
use MobiMarket\OneApi\Entities\Media;
use MobiMarket\OneApi\Entities\MediaMetadataResponse;
use MobiMarket\OneApi\Entities\MessageRequest;
use MobiMarket\OneApi\Entities\MessageResponse;
use MobiMarket\OneApi\Entities\MessageStatusResponse;
use MobiMarket\OneApi\Entities\UploadMediaResponse;
use MobiMarket\OneApi\Traits\RestApiClient;

class OneApiRestApi
{
    use RestApiClient;

    public function __construct(
        string $base_uri,
        float $timeout,
        string $api_key
    ) {
        $this->buildClient(
            $base_uri,
            $timeout,
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
}
