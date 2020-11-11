<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Media reference, doesn't actually contain the data, incoming event variant.
 */
class IncomingMedia extends FillableEntity
{
    /**
     * @var string
     */
    public $contentType;

    /**
     * @var string
     */
    public $downloadUrl;

    /**
     * @var string
     */
    public $sha256Hash;

    /**
     * @var int
     */
    public $byteSize;

    /**
     * @var string
     */
    public $fileName;
}
