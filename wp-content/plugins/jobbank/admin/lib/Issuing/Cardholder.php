<?php

namespace Stripe\Issuing;

/**
 * Class Cardholder
 *
 * @job string $id
 * @job string $object
 * @job mixed|null $authorization_controls
 * @job mixed $billing
 * @job int $created
 * @job string|null $email
 * @job bool $is_default
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string $name
 * @job string|null $phone_number
 * @job mixed $requirements
 * @job string $status
 * @job string $type
 *
 * @package Stripe\Issuing
 */
class Cardholder extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'issuing.cardholder';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Retrieve;
    use \Stripe\ApiOperations\Update;
}
