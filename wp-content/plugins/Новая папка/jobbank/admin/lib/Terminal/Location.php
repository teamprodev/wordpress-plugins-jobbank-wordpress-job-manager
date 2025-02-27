<?php

namespace Stripe\Terminal;

/**
 * Class Location
 *
 * @job string $id
 * @job string $object
 * @job mixed $address
 * @job string $display_name
 *
 * @package Stripe\Terminal
 */
class Location extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'terminal.location';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Delete;
    use \Stripe\ApiOperations\Retrieve;
    use \Stripe\ApiOperations\Update;
}
