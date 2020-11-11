<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

use MobiMarket\OneApi\Enum\Channel;

/**
 * The request we send to them to send them messages.
 */
class SingleMessageRequest extends FillableEntity
{
    /**
     * The string value contains actual message content.
     * Character set UTF-8
     * WhatsApp Inline Media: base64 encoded media data
     * Not required for media by reference message sending.
     *
     * Limit
     *  WhatsApp text:  4096 characters
     *  WhatsApp media: 1MB (total 20MB payload limit)
     *
     * @var string|null
     */
    public $content;

    /**
     * @var string
     */
    public $to;

    /**
     * @var string|null
     */
    public $encryptionKey;

    /**
     * @var string|null
     */
    public $clientMessageId;

    /**
     * @var string|null
     */
    public $scheduledDeliveryTime;

    /**
     * @var int|null
     */
    public $validityPeriod;

    /**
     * @var string
     *
     * @see Channel
     */
    public $channel = Channel::SMS;

    /**
     * @var HighlyStructuredMessage|null
     */
    public $hsm;

    /**
     * @var Location|null
     */
    public $location;

    /**
     * @var Contact[]|null
     */
    public $contacts;

    /**
     * @var Media|null
     */
    public $media;

    /**
     * @var bool|null
     */
    public $previewFirstUrl;

    /**
     * @var Template|null
     */
    public $template;

    /**
     * @var string|null
     */
    public $from;

    /**
     * @var string|null
     */
    public $userDataHeader;

    /**
     * @var bool|null
     */
    public $binary;

    /**
     * Check the message is valid.
     */
    public function isValid(): bool
    {
        if (empty($this->to)) {
            return false;
        }

        if (Channel::SMS === $this->channel) {
            // SMS
            if (empty($this->from)) {
                return false;
            }

            // documentation says 'characters' and UTF-8 encoded .: mb chars counted as 1
            if (empty($this->content) || \mb_strlen($this->content) > 4096) {
                return false;
            }

            if (!empty($this->media)) {
                return false;
            }

            if (!empty($this->contacts)) {
                return false;
            }

            if (!empty($this->template)) {
                return false;
            }

            if (!empty($this->previewFirstUrl)) {
                return false;
            }
        } elseif (Channel::WHATSAPP === $this->channel) {
            // Whatsapp
            if (!empty($this->from)) {
                return false;
            }

            // 1 MB limit
            if ($this->content && \strlen($this->content) > 1024 * 1024) {
                return false;
            }
        }

        return true;
    }
}
