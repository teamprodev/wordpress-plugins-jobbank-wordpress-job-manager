<?php

namespace Stripe;

/**
 * Class Coupon
 *
 * @job string $id
 * @job string $object
 * @job int|null $amount_off
 * @job int $created
 * @job string|null $currency
 * @job string $duration
 * @job int|null $duration_in_months
 * @job bool $livemode
 * @job int|null $max_redemptions
 * @job \Stripe\StripeObject $metadata
 * @job string|null $name
 * @job float|null $percent_off
 * @job int|null $redeem_by
 * @job int $times_redeemed
 * @job bool $valid
 *
 * @package Stripe
 */
class Coupon extends ApiResource
{
    const OBJECT_NAME = 'coupon';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
