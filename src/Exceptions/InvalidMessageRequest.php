<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Exceptions;

use MobiMarket\OneApi\Entities\SingleMessageRequest;
use Throwable;

/**
 * An invalid message was transposed, theres no point sending a request with known bad data.
 */
class InvalidMessageRequest extends OneApiBaseException
{
    /**
     * @var SingleMessageRequest
     */
    protected $message;

    public function __construct(SingleMessageRequest $message, ?Throwable $previous = null)
    {
        $this->message = $message;

        parent::__construct(\json_encode($message->toArray()), 800, $previous);
    }

    public function getMessageRequest(): SingleMessageRequest
    {
        return $this->response;
    }
}
