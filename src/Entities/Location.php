<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Location data for a message.
 */
class Location extends FillableEntity
{
    /**
     * @var string
     */
    public $longitude;

    /**
     * @var string
     */
    public $latitude;

    /**
     * @var string|null
     */
    public $name;

    /**
     * @var string|null
     */
    public $address;
}
