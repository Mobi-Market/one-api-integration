<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Response from uploading media.
 */
class MessageStatusResponse extends EntityWithApiError
{
    /**
     * @var MessageStatusEntry
     */
    public $sms;

    /**
     * @var MessageStatusEntry
     */
    public $whatsapp;

    public function __construct(array $fill = [])
    {
        $sms = $fill['sms'] ?? null;
        if ($sms) {
            $this->sms = new MessageStatusEntry($sms);
            unset($fill['sms']);
        }

        $whatsapp = $fill['whatsapp'] ?? null;
        if ($whatsapp) {
            $this->whatsapp = new MessageStatusEntry($whatsapp);
            unset($fill['whatsapp']);
        }

        parent::__construct($fill);
    }
}
