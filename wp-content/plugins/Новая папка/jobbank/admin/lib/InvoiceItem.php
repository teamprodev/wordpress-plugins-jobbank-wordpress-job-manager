<?php

namespace Stripe;

/**
 * Class InvoiceItem
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job string $currency
 * @job string $customer
 * @job int $date
 * @job string|null $description
 * @job bool $discountable
 * @job string|null $invoice
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job mixed $period
 * @job \Stripe\Plan|null $plan
 * @job bool $proration
 * @job int $quantity
 * @job string|null $subscription
 * @job string $subscription_item
 * @job array|null $tax_rates
 * @job int|null $unit_amount
 * @job string|null $unit_amount_decimal
 *
 * @package Stripe
 */
class InvoiceItem extends ApiResource
{
    const OBJECT_NAME = 'invoiceitem';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
