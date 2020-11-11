<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

use MobiMarket\OneApi\Enum\TemplateHeaderType;

/**
 * Whatsapp template header.
 */
class TemplateHeader extends FillableEntity
{
    /**
     * @var string
     *
     * @see TemplateHeaderType
     */
    public $type = TemplateHeaderType::TEXT;

    /**
     * @var array|null
     */
    public $text;

    /**
     * @var array|null
     */
    public $media;
}
