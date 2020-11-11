<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

use MobiMarket\OneApi\Exceptions\InvalidMessageRequest;

/**
 * The request we send to them to send them messages.
 */
class MessageRequest extends FillableEntity
{
    /**
     * @var SingleMessageRequest[]
     */
    public $messages = [];

    /**
     * Adds a message to the request.
     */
    public function addMessage(SingleMessageRequest $message): void
    {
        if (false === $message->isValid()) {
            throw new InvalidMessageRequest($message);
        }

        $this->messages[] = $message;
    }
}
