<?php

namespace Stripe;

/**
 * Class RecipientTransfer
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job int $amount_reversed
 * @job string $balance_transaction
 * @job string $bank_account
 * @job string $card
 * @job int $created
 * @job string $currency
 * @job int $date
 * @job string $description
 * @job string $destination
 * @job string $failure_code
 * @job string $failure_message
 * @job bool $livemode
 * @job StripeObject $metadata
 * @job string $method
 * @job string $recipient
 * @job mixed $reversals
 * @job bool $reversed
 * @job string $source_type
 * @job string $statement_descriptor
 * @job string $status
 * @job string $type
 *
 * @package Stripe
 */
class RecipientTransfer extends ApiResource
{
    const OBJECT_NAME = 'recipient_transfer';
}
