<?php

namespace Stripe\Radar;

/**
 * Class ValueListItem
 *
 * @job string $id
 * @job string $object
 * @job int $created
 * @job string $created_by
 * @job bool $livemode
 * @job string $value
 * @job string $value_list
 *
 * @package Stripe\Radar
 */
class ValueListItem extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'radar.value_list_item';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Delete;
    use \Stripe\ApiOperations\Retrieve;
}
