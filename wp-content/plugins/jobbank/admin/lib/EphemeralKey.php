<?php

namespace Stripe;

/**
 * Class EphemeralKey
 *
 * @job string $id
 * @job string $object
 * @job int $created
 * @job int $expires
 * @job bool $livemode
 * @job string $secret
 * @job array $associated_objects
 *
 * @package Stripe
 */
class EphemeralKey extends ApiResource
{
    const OBJECT_NAME = 'ephemeral_key';

    use ApiOperations\Create {
        create as protected _create;
    }
    use ApiOperations\Delete;

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\InvalidArgumentException if stripe_version is missing
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return EphemeralKey The created key.
     */
    public static function create($params = null, $opts = null)
    {
        if (!$opts || !isset($opts['stripe_version'])) {
            throw new Exception\InvalidArgumentException('stripe_version must be specified to create an ephemeral key');
        }
        return self::_create($params, $opts);
    }
}
