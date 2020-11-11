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
class EntityWithApiError extends FillableEntity
{
    /**
     * @var ApiError|null
     */
    public $error = null;

    public function __construct(array $fill = [])
    {
        $error = $fill['error'] ?? null;
        if ($error) {
            $this->error = new ApiError($error);
            unset($fill['error']);
        }

        parent::__construct($fill);
    }
}
