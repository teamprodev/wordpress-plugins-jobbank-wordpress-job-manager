<?php

namespace Stripe;

/**
 * Class FileLink
 *
 * @job string $id
 * @job string $object
 * @job int $created
 * @job bool $expired
 * @job int|null $expires_at
 * @job string $file
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string|null $url
 *
 * @package Stripe
 */
class FileLink extends ApiResource
{
    const OBJECT_NAME = 'file_link';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
