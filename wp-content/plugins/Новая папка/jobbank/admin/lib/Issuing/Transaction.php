<?php

namespace Stripe\Issuing;

/**
 * Class Transaction
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job string|null $authorization
 * @job string|null $balance_transaction
 * @job string $card
 * @job string|null $cardholder
 * @job int $created
 * @job string $currency
 * @job string|null $dispute
 * @job bool $livemode
 * @job int $merchant_amount
 * @job string $merchant_currency
 * @job mixed $merchant_data
 * @job \Stripe\StripeObject $metadata
 * @job string $type
 *
 * @package Stripe\Issuing
 */
class Transaction extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'issuing.transaction';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Retrieve;
    use \Stripe\ApiOperations\Update;
}
