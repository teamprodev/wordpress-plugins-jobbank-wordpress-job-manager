<?php

namespace Stripe;

/**
 * Class TaxRate
 *
 * @job string $id
 * @job string $object
 * @job bool $active
 * @job int $created
 * @job string|null $description
 * @job string $display_name
 * @job bool $inclusive
 * @job string|null $jurisdiction
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job float $percentage
 *
 * @package Stripe
 */
class TaxRate extends ApiResource
{
    const OBJECT_NAME = 'tax_rate';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
