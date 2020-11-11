<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Account balance response.
 */
class BalanceResponse extends EntityWithApiError
{
    /**
     * @var float
     */
    public $balance = 0.00;

    /**
     * @var string
     */
    public $currency = 'GBP';
}
