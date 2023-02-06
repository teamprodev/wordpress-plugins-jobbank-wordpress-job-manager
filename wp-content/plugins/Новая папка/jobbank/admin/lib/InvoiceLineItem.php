<?php

namespace Stripe;

/**
 * Class InvoiceLineItem
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job string $currency
 * @job string $description
 * @job bool $discountable
 * @job string $invoice_item
 * @job bool $livemode
 * @job StripeObject $metadata
 * @job mixed $period
 * @job Plan $plan
 * @job bool $proration
 * @job int $quantity
 * @job string $subscription
 * @job string $subscription_item
 * @job array $tax_amounts
 * @job array $tax_rates
 * @job string $type
 *
 * @package Stripe
 */
class InvoiceLineItem extends ApiResource
{
    const OBJECT_NAME = 'line_item';
}
