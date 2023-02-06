<?php

namespace Stripe;

/**
 * Class CountrySpec
 *
 * @job string $id
 * @job string $object
 * @job string $default_currency
 * @job mixed $supported_bank_account_currencies
 * @job string[] $supported_payment_currencies
 * @job string[] $supported_payment_methods
 * @job string[] $supported_transfer_countries
 * @job mixed $verification_fields
 *
 * @package Stripe
 */
class CountrySpec extends ApiResource
{
    const OBJECT_NAME = 'country_spec';

    use ApiOperations\All;
    use ApiOperations\Retrieve;
}
