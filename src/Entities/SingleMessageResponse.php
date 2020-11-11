<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * A single message.
 */
class SingleMessageResponse extends EntityWithApiError
{
    /**
     * @var string|null
     */
    public $apiMessageId = null;

    /**
     * @var string|null
     */
    public $clientMessageId = null;

    /**
     * @var bool
     */
    public $accepted = false;

    /**
     * @var string
     */
    public $to;
}
