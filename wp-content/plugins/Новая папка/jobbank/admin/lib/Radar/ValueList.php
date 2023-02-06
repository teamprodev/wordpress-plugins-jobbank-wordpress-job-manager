<?php

namespace Stripe\Radar;

/**
 * Class ValueList
 *
 * @job string $id
 * @job string $object
 * @job string $alias
 * @job int $created
 * @job string $created_by
 * @job string $item_type
 * @job \Stripe\Collection $list_items
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string $name
 *
 * @package Stripe\Radar
 */
class ValueList extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'radar.value_list';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Delete;
    use \Stripe\ApiOperations\Retrieve;
    use \Stripe\ApiOperations\Update;
}
