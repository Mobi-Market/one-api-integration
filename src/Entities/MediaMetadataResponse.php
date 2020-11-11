<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Media metadata response.
 */
class MediaMetadataResponse extends EntityWithApiError
{
    /**
     * @var int
     */
    public $expirationTime;

    /**
     * @var bool
     */
    public $broadcastAllowed;

    // below is only set if error

    /**
     * @var string|null
     */
    public $fileId;

    /**
     * @var bool|null
     */
    public $accepted;
}
