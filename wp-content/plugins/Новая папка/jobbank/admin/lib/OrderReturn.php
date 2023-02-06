<?php

namespace Stripe;

/**
 * Class OrderReturn
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job int $created
 * @job string $currency
 * @job OrderItem[] $items
 * @job bool $livemode
 * @job string|null $order
 * @job string|null $refund
 *
 * @package Stripe
 */
class OrderReturn extends ApiResource
{
    const OBJECT_NAME = 'order_return';

    use ApiOperations\All;
    use ApiOperations\Retrieve;
}
