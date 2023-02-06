<?php

namespace Stripe;

/**
 * Class UsageRecord
 *
 * @package Stripe
 *
 * @job string $id
 * @job string $object
 * @job bool $livemode
 * @job int $quantity
 * @job string $subscription_item
 * @job int $timestamp
 */
class UsageRecord extends ApiResource
{
    const OBJECT_NAME = 'usage_record';
}
