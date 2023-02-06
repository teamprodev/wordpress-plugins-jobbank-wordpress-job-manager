<?php

namespace Stripe;

/**
 * Class SKU
 *
 * @job string $id
 * @job string $object
 * @job bool $active
 * @job mixed $attributes
 * @job int $created
 * @job string $currency
 * @job string|null $image
 * @job mixed $inventory
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job mixed|null $package_dimensions
 * @job int $price
 * @job string $product
 * @job int $updated
 *
 * @package Stripe
 */
class SKU extends ApiResource
{
    const OBJECT_NAME = 'sku';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
