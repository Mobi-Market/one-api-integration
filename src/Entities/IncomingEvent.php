<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

use MobiMarket\OneApi\Enum\Channel;

/**
 * Generic data shared across all incoming message types including status.
 */
class IncomingEvent extends FillableEntity
{
    /**
     * @var string
     *
     * @see Channel
     */
    public $channel = Channel::SMS;

    /**
     * @var string
     */
    public $messageId;

    /**
     * @var int
     */
    public $timestamp;
}
