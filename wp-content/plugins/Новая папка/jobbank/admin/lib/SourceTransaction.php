<?php

namespace Stripe;

/**
 * Class SourceTransaction
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job int $created
 * @job string $customer_data
 * @job string $currency
 * @job string $type
 * @job mixed $ach_credit_transfer
 *
 * @package Stripe
 */
class SourceTransaction extends ApiResource
{
    const OBJECT_NAME = 'source_transaction';
}
