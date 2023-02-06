<?php

namespace Stripe;

/**
 * Class Balance
 *
 * @job string $object
 * @job array $available
 * @job array $connect_reserved
 * @job bool $livemode
 * @job array $pending
 *
 * @package Stripe
 */
class Balance extends SingletonApiResource
{
    const OBJECT_NAME = 'balance';

    /**
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Balance
     */
    public static function retrieve($opts = null)
    {
        return self::_singletonRetrieve($opts);
    }
}
