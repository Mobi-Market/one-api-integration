<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Singular incoming message of type location.
 */
class IncomingMessageLocation extends IncomingMessageType
{
    /**
     * @var string
     */
    public $charset;

    /**
     * @var string
     */
    public $longitude;

    /**
     * @var string
     */
    public $latitude;

    /**
     * @var string
     *
     * @deprecated
     */
    public $latitute;

    /**
     * @var string|null
     */
    public $locationName;

    /**
     * @var string|null
     */
    public $locationAddress;
}
