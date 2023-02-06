<?php

namespace Stripe;

/**
 * Class AccountLink
 *
 * @job string $object
 * @job int $created
 * @job int $expires_at
 * @job string $url
 *
 * @package Stripe
 */
class AccountLink extends ApiResource
{
    const OBJECT_NAME = 'account_link';

    use ApiOperations\Create;
}
