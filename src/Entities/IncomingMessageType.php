<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Generic data shared across all incoming message types (not status).
 */
class IncomingMessageType extends IncomingEvent
{
    /**
     * @var string
     */
    public $relatedMessageId;

    /**
     * @var string
     */
    public $relatedClientMessageId;

    /**
     * @var string
     */
    public $from;

    /**
     * @var string
     */
    public $to;

    /**
     * @var string
     */
    public $encryptionKey;

    /**
     * @var array
     */
    public $whatsapp;
}
