<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi\Entities;

/**
 * Response from message endpoint, probably the chunkiest one other than events.
 */
class MessageResponse extends EntityWithApiError
{
    /**
     * @var SingleMessageResponse[]
     */
    public $messages = [];

    /**
     * @var int
     */
    protected $errors = 0;

    public function __construct(array $fill = [])
    {
        foreach ($fill['messages'] ?? [] as $message) {
            $entity           = new SingleMessageResponse($message);
            $this->messages[] = $entity;

            if (null !== $entity->error) {
                ++$this->errors;
            }
        }

        unset($fill['messages']);
        parent::__construct($fill);
    }

    /**
     * Does the response have any errors at all?
     */
    public function hasErrors(): bool
    {
        return $this->errors > 0 || null !== $this->error;
    }
}
