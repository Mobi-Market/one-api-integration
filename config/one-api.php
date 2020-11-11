<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

return [
    /*
     * API Details used for the internal client.
     */
    'api' => [
        'url'        => env('ONEAPI_API_URL', 'https://platform.clickatell.com/v1/'),
        'timeout'    => (float) env('ONEAPI_API_TIMEOUT', 10.0),
        'should_log' => env('ONEAPI_API_SHOULD_LOG', true),
        'key'        => env('ONEAPI_API_KEY', 'INVALID'),
    ],
];
