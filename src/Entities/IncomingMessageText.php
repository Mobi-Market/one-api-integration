<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Singular incoming message of type text.
 */
class IncomingMessageText extends IncomingMessageType
{
    /**
     * @var string
     */
    public $charset;

    /**
     * @var string
     */
    public $content;

    /**
     * @var array
     */
    public $sms;
}
