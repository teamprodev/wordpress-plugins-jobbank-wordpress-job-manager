<?php

namespace Stripe;

/**
 * Class WebhookEndpoint
 *
 * @job string $id
 * @job string $object
 * @job string|null $api_version
 * @job string|null $application
 * @job int $created
 * @job string[] $enabled_events
 * @job bool $livemode
 * @job string $secret
 * @job string $status
 * @job string $url
 *
 * @package Stripe
 */
class WebhookEndpoint extends ApiResource
{
    const OBJECT_NAME = 'webhook_endpoint';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
