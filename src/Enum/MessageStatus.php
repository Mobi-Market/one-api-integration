<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Enum;

final class MessageStatus extends BaseEnum
{
    public const UNKNOWN                           = 'UNKNOWN';
    public const QUEUED                            = 'QUEUED';
    public const SCHEDULED                         = 'SCHEDULED';
    public const SENT_TO_SUPPLIER                  = 'SENT_TO_SUPPLIER';
    public const DEVICE_ACK                        = 'DEVICE_ACK';
    public const READ                              = 'READ';
    public const EXPIRED                           = 'EXPIRED';
    public const STOPPED_BY_USER                   = 'STOPPED_BY_USER';
    public const STOPPED_BY_ADMIN                  = 'STOPPED_BY_ADMIN';
    public const DELIVERY_FAILURE                  = 'DELIVERY_FAILURE';
    public const EMULATED                          = 'EMULATED';
    public const INSUFFICIENT_ACCOUNT_BALANCE      = 'INSUFFICIENT_ACCOUNT_BALANCE';
    public const VOLUME_LIMIT                      = 'VOLUME_LIMIT';
    public const VOLUME_LIMIT_DAILY                = 'VOLUME_LIMIT_DAILY';
    public const VOLUME_LIMIT_MONTHLY              = 'VOLUME_LIMIT_MONTHLY';
    public const RECIPIENT_DOES_NOT_EXIST          = 'RECIPIENT_DOES_NOT_EXIST';
    public const ENCRYPTION_ACCESS_DENIED          = 'ENCRYPTION_ACCESS_DENIED';
    public const ENCRYPTION_CONTENT_ERROR          = 'ENCRYPTION_CONTENT_ERROR';
    public const MEDIA_NOT_FOUND                   = 'MEDIA_NOT_FOUND';
    public const MEDIA_SIZE_ERROR                  = 'MEDIA_SIZE_ERROR';
    public const MEDIA_CHECKSUM_FAILURE            = 'MEDIA_CHECKSUM_FAILURE';
    public const MEDIA_REJECTED_BY_SUPPLIER        = 'MEDIA_REJECTED_BY_SUPPLIER';
    public const MEDIA_METADATA_ERROR              = 'MEDIA_METADATA_ERROR';
    public const ROUTING_ERROR                     = 'ROUTING_ERROR';
    public const WHATSAPP_ACCOUNT_PAYMENT_ISSUE    = 'WHATSAPP_ACCOUNT_PAYMENT_ISSUE';
    public const WHATSAPP_RE_ENGAGEMENT_REQUIRED   = 'WHATSAPP_RE_ENGAGEMENT_REQUIRED';
    public const WHATSAPP_SPAM_RATE_LIMIT_REACHED  = 'WHATSAPP_SPAM_RATE_LIMIT_REACHED';
    public const WHATSAPP_SERVER_RATE_LIMIT        = 'WHATSAPP_SERVER_RATE_LIMIT';
    public const WHATSAPP_HSM_NOT_AVAILABLE        = 'WHATSAPP_HSM_NOT_AVAILABLE';
    public const WHATSAPP_HSM_PARAM_COUNT_MISMATCH = 'WHATSAPP_HSM_PARAM_COUNT_MISMATCH';
    public const WHATSAPP_HSM_IS_MISSING           = 'WHATSAPP_HSM_IS_MISSING';
    public const WHATSAPP_HSM_DOWNLOAD_FAILED      = 'WHATSAPP_HSM_DOWNLOAD_FAILED';
    public const WHATSAPP_HSM_PACK_IS_MISSING      = 'WHATSAPP_HSM_PACK_IS_MISSING';
    public const WHATSAPP_EXPERIMENTAL_NUMBER      = 'WHATSAPP_EXPERIMENTAL_NUMBER';
}
