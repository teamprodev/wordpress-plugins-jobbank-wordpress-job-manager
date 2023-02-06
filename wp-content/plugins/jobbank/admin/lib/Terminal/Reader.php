<?php

namespace Stripe\Terminal;

/**
 * Class Reader
 *
 * @job string $id
 * @job string $object
 * @job string|null $device_sw_version
 * @job string $device_type
 * @job string|null $ip_address
 * @job string $label
 * @job string|null $location
 * @job string $serial_number
 * @job string|null $status
 *
 * @package Stripe\Terminal
 */
class Reader extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'terminal.reader';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Delete;
    use \Stripe\ApiOperations\Retrieve;
    use \Stripe\ApiOperations\Update;
}
