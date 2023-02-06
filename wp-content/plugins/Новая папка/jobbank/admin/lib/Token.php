<?php

namespace Stripe;

/**
 * Class Token
 *
 * @job string $id
 * @job string $object
 * @job \Stripe\BankAccount $bank_account
 * @job \Stripe\Card $card
 * @job string|null $client_ip
 * @job int $created
 * @job bool $livemode
 * @job string $type
 * @job bool $used
 *
 * @package Stripe
 */
class Token extends ApiResource
{
    const OBJECT_NAME = 'token';

    use ApiOperations\Create;
    use ApiOperations\Retrieve;

    /**
     * Possible string representations of the token type.
     * @link https://stripe.com/docs/api/tokens/object#token_object-type
     */
    const TYPE_ACCOUNT      = 'account';
    const TYPE_BANK_ACCOUNT = 'bank_account';
    const TYPE_CARD         = 'card';
    const TYPE_PII          = 'pii';
}
