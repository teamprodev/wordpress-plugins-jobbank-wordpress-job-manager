<?php

namespace Stripe;

/**
 * Class ExchangeRate
 *
 * @job string $id
 * @job string $object
 * @job mixed $rates
 *
 * @package Stripe
 */
class ExchangeRate extends ApiResource
{
    const OBJECT_NAME = 'exchange_rate';

    use ApiOperations\All;
    use ApiOperations\Retrieve;
}
