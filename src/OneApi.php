<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi;

use Illuminate\Support\Facades\Facade;

class OneApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OneApiRestApi::class;
    }
}
