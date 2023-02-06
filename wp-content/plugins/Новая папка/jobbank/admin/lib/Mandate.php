<?php

namespace Stripe;

/**
 * Class Mandate
 *
 * @job string $id
 * @job string $object
 * @job mixed $customer_acceptance
 * @job bool $livemode
 * @job mixed|null $multi_use
 * @job string $payment_method
 * @job mixed $payment_method_details
 * @job mixed|null $single_use
 * @job string $status
 * @job string $type
 *
 * @package Stripe
 */
class Mandate extends ApiResource
{
    const OBJECT_NAME = 'mandate';

    use ApiOperations\Retrieve;
}
