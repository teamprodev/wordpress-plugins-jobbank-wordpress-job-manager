<?php

namespace Stripe\Issuing;

/**
 * Class Dispute
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job int $created
 * @job string $currency
 * @job string $disputed_transaction
 * @job mixed $evidence
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string $reason
 * @job string $status
 *
 * @package Stripe\Issuing
 */
class Dispute extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'issuing.dispute';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Retrieve;
    use \Stripe\ApiOperations\Update;
}
