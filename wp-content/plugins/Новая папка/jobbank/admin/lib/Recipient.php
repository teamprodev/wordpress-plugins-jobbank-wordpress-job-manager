<?php

namespace Stripe;

/**
 * Class Recipient
 *
 * @job string $id
 * @job string $object
 * @job mixed|null $active_account
 * @job \Stripe\Collection|null $cards
 * @job int $created
 * @job string|null $default_card
 * @job string|null $description
 * @job string|null $email
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string|null $migrated_to
 * @job string|null $name
 * @job string $rolled_back_from
 * @job string $type
 * @job bool $verified
 *
 * @package Stripe
 */
class Recipient extends ApiResource
{
    const OBJECT_NAME = 'recipient';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
