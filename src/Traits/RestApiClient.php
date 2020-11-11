<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Traits;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Log;
use MobiMarket\OneApi\Exceptions\NotFound;
use MobiMarket\OneApi\Exceptions\PaymentRequired;
use MobiMarket\OneApi\Exceptions\RequestFailed;
use MobiMarket\OneApi\Exceptions\ServiceUnavailable;
use Psr\Http\Message\ResponseInterface as HttpResponse;

trait RestApiClient
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $api_key;

    /**
     * Sets up require parameters for the api.
     */
    public function buildClient(
        string $base_uri,
        float $timeout,
        bool $should_log,
        string $api_key
    ): void {
        $stack = HandlerStack::create();

        if (true === $should_log) {
            $stack->push(
                Middleware::log(
                    Log::getMonolog(),
                    new MessageFormatter('{req_body} - {res_body}')
                )
            );

            $stack->push(
                Middleware::log(
                    Log::getMonolog(),
                    new MessageFormatter('{uri} - {method} - {code}')
                )
            );
        }

        $this->client = new HttpClient([
            // Base URI is used with relative requests
            'base_uri'    => $base_uri,
            // You can set any number of default request options.
            'timeout'     => $timeout,
            // Handler stack for logging purposes.
            'handler'     => $stack,
            // Disable internal errors to let us catch all status codes.
            'http_errors' => false,
        ]);

        $this->api_key = $api_key;
    }

    /**
     * Send the raw request to the API.
     */
    protected function sendRawAPIRequest(
        string $method,
        string $endpoint,
        ?string $data = null,
        ?array $headers = null,
        ?array $query = null
    ): array {
        $headers = $headers ?? [];

        /**
         * @var HttpResponse
         */
        $response = $this->client->{$method}($endpoint, [
            'body'      => $data,
            'query'     => $query,
            'headers'   => [
                'Accept'        => 'application/json',
                'Authorization' => $this->api_key,
            ] + $headers,
        ]);

        $code = $response->getStatusCode();

        // Treat some error codes different as they aren't errors
        // but indications that we need to either take action or do
        // something like delay the request, and should probably inform
        // the user.
        switch ($code) {
            case 200: // OK
            case 201: // OK
            case 202: // OK
            case 207: // OK (Some data is rejected)
                break;

            case 402: // PAYMENT REQUIRED
                throw new PaymentRequired($response);
            case 404: // NOT FOUND
                throw new NotFound($response);
            case 503: // SERVICE UNAVAILABLE
                throw new ServiceUnavailable($response);
            case 400: // BAD REQUEST
            case 401: // UNAUTHORIZED
            default:
                // Codes from 400 to 5XX are errors.
                if ($code >= 400 && $code <= 599) {
                    throw new RequestFailed($response);
                }
        }

        $body = (string) $response->getBody() ?? '';

        // This should always be an array.
        return \json_decode($body, true) ?? ['content' => $body];
    }

    /**
     * Send the request to the API.
     */
    protected function sendAPIRequest(
        string $method,
        string $endpoint,
        array $data = null,
        ?array $headers = null,
        ?array $query = null
    ): array {
        $body = \json_encode($data ?? []);

        return $this->sendRawAPIRequest($method, $endpoint, $data, [
            'Content-Type' => 'application/json',
        ] + $headers, $query);
    }
}
