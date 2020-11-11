<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

use MobiMarket\OneApi\Enum\MessageStatus;

/**
 * Singular incoming message status update.
 */
class IncomingMessageStatus extends IncomingEvent
{
    /**
     * @var string
     *
     * @see MessageStatus
     */
    public $status = MessageStatus::UNKNOWN;

    /**
     * @var string
     */
    public $clientMessageId;
}
