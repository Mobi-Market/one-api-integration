<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Whatsapp template, different from a HSM apparently...
 */
class Template extends FillableEntity
{
    /**
     * @var string
     */
    public $templateName;

    /**
     * @var TemplateBody
     */
    public $body;

    /**
     * @var TemplateHeader
     */
    public $header;
}
