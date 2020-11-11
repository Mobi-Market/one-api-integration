<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Exceptions;

use Psr\Http\Message\ResponseInterface as HttpResponse;
use Throwable;

/**
 * Overly generic exception which is base class of useful ones.
 */
class RequestFailed extends OneApiBaseException
{
    /**
     * @var HttpResponse
     */
    protected $response;

    public function __construct(HttpResponse $response, ?Throwable $previous = null)
    {
        $this->response = $response;

        parent::__construct((string) $response->getBody(), $response->getStatusCode(), $previous);
    }

    public function getResponse(): HttpResponse
    {
        return $this->response;
    }
}
