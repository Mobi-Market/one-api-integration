<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Whatsapp highly structured message (template).
 */
class HighlyStructuredMessage extends FillableEntity
{
    /**
     * @var string
     */
    public $template;

    /**
     * @var array
     */
    public $parameters = [];
}
