<?php

namespace Stripe;

/**
 * Class Plan
 *
 * @job string $id
 * @job string $object
 * @job bool $active
 * @job string|null $aggregate_usage
 * @job int|null $amount
 * @job string|null $amount_decimal
 * @job string|null $billing_scheme
 * @job int $created
 * @job string $currency
 * @job string $interval
 * @job int $interval_count
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string|null $nickname
 * @job string|null $product
 * @job mixed|null $tiers
 * @job string|null $tiers_mode
 * @job mixed|null $transform_usage
 * @job int|null $trial_period_days
 * @job string $usage_type
 *
 * @package Stripe
 */
class Plan extends ApiResource
{
    const OBJECT_NAME = 'plan';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
