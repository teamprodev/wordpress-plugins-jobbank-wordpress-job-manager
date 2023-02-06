<?php

namespace Stripe;

/**
 * Class OrderItem
 *
 * @job string $object
 * @job int $amount
 * @job string $currency
 * @job string $description
 * @job string $parent
 * @job int $quantity
 * @job string $type
 *
 * @package Stripe
 */
class OrderItem extends StripeObject
{
    const OBJECT_NAME = 'order_item';
}
