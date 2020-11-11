<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Exceptions;

/**
 * Used for media and such, account or media not found, can be due to > 30 days.
 */
class NotFound extends RequestFailed
{
}
