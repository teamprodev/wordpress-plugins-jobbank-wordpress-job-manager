<?php

namespace Stripe;

/**
 * Class Discount
 *
 * @job string $object
 * @job Coupon $coupon
 * @job string $customer
 * @job int $end
 * @job int $start
 * @job string $subscription
 *
 * @package Stripe
 */
class Discount extends StripeObject
{
    const OBJECT_NAME = 'discount';
}
