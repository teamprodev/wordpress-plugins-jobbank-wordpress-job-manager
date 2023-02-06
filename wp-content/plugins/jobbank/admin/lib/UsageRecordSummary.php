<?php

namespace Stripe;

/**
 * Class UsageRecord
 *
 * @package Stripe
 *
 * @job string $id
 * @job string $object
 * @job string $invoice
 * @job bool $livemode
 * @job mixed $period
 * @job string $subscription_item
 * @job int $total_usage
 */
class UsageRecordSummary extends ApiResource
{
    const OBJECT_NAME = 'usage_record_summary';
}
