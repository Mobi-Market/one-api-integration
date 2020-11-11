<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Request sent to us when Clickatell hits our endpoint.
 */
class CallbackRequest
{
    /**
     * @var string
     */
    public $integrationId;

    /**
     * @var string
     */
    public $integrationName;

    /**
     * @var Collection<IncomingEvent>
     */
    public $events = [];

    /**
     * @var string[]
     */
    protected $mapping = [
        'messageStatusUpdate' => IncomingMessageStatus::class,
        'moText'              => IncomingMessageText::class,
        'moMedia'             => IncomingMessageMedia::class,
        'moLocation'          => IncomingMessageLocation::class,
    ];

    public function __construct(Request $request)
    {
        $this->integrationId   = $request->integrationId;
        $this->integrationName = $request->integrationName;

        $this->events = collect();

        foreach ($request->event ?? [] as $type => $events) {
            $class = $this->mapping[$type] ?? null;
            if (null === $class) {
                continue;
            }

            $mapped = collect($events ?? [])
                ->mapInto($class)
                ->toArray();

            $this->events = $this->events->merge($mapped);
        }
    }
}
