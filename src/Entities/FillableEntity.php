<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

class FillableEntity
{
    public function __construct(iterable $fill = [])
    {
        foreach ($fill as $property => $value) {
            $this->{$property} = $value;
        }
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}
