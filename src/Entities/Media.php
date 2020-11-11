<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Media reference, doesn't actually contain the data.
 */
class Media extends FillableEntity
{
    /**
     * @var string
     */
    public $contentType;

    /**
     * @var string|null
     */
    public $caption;

    /**
     * @var string
     */
    public $sha256Hash;

    /**
     * @var string
     */
    public $fileId;
}
