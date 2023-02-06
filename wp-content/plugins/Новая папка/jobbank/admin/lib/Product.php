<?php

namespace Stripe;

/**
 * Class Product
 *
 * @job string $id
 * @job string $object
 * @job bool|null $active
 * @job string[]|null $attributes
 * @job string|null $caption
 * @job int $created
 * @job string[] $deactivate_on
 * @job string|null $description
 * @job string[] $images
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string $name
 * @job mixed|null $package_dimensions
 * @job bool|null $shippable
 * @job string|null $statement_descriptor
 * @job string $type
 * @job string|null $unit_label
 * @job int $updated
 * @job string|null $url
 *
 * @package Stripe
 */
class Product extends ApiResource
{
    const OBJECT_NAME = 'product';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    /**
     * Possible string representations of the type of product.
     * @link https://stripe.com/docs/api/service_products/object#service_product_object-type
     */
    const TYPE_GOOD    = 'good';
    const TYPE_SERVICE = 'service';
}
