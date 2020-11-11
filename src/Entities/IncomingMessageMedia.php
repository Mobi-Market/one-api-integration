<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Singular incoming message of type media.
 */
class IncomingMessageMedia extends IncomingMessageType
{
    /**
     * @var string
     */
    public $caption;

    // inline
    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $sha256Hash;

    /**
     * @var string
     */
    public $contentType;

    // ref
    /**
     * @var IncomingMedia[]
     */
    public $files;

    public function __construct(array $fill = [])
    {
        $files = $fill['files'] ?? null;
        if ($files) {
            $this->files = collect($files)
                ->mapInto(IncomingMedia::class)
                ->toArray();

            unset($fill['files']);
        }

        parent::__construct($fill);
    }
}
