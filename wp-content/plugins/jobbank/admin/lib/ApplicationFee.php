<?php

namespace Stripe;

/**
 * Class ApplicationFee
 *
 * @job string $id
 * @job string $object
 * @job string $account
 * @job int $amount
 * @job int $amount_refunded
 * @job string $application
 * @job string|null $balance_transaction
 * @job string $charge
 * @job int $created
 * @job string $currency
 * @job bool $livemode
 * @job string|null $originating_transaction
 * @job bool $refunded
 * @job \Stripe\Collection $refunds
 *
 * @package Stripe
 */
class ApplicationFee extends ApiResource
{
    const OBJECT_NAME = 'application_fee';

    use ApiOperations\All;
    use ApiOperations\NestedResource;
    use ApiOperations\Retrieve;

    const PATH_REFUNDS = '/refunds';

    /**
     * @param string $id The ID of the application fee on which to create the fee refund.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return ApplicationFeeRefund
     */
    public static function createRefund($id, $params = null, $opts = null)
    {
        return self::_createNestedResource($id, static::PATH_REFUNDS, $params, $opts);
    }

    /**
     * @param string $id The ID of the application fee to which the fee refund belongs.
     * @param string $refundId The ID of the fee refund to retrieve.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return ApplicationFeeRefund
     */
    public static function retrieveRefund($id, $refundId, $params = null, $opts = null)
    {
        return self::_retrieveNestedResource($id, static::PATH_REFUNDS, $refundId, $params, $opts);
    }

    /**
     * @param string $id The ID of the application fee to which the fee refund belongs.
     * @param string $refundId The ID of the fee refund to update.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return ApplicationFeeRefund
     */
    public static function updateRefund($id, $refundId, $params = null, $opts = null)
    {
        return self::_updateNestedResource($id, static::PATH_REFUNDS, $refundId, $params, $opts);
    }

    /**
     * @param string $id The ID of the application fee on which to retrieve the fee refunds.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Collection The list of fee refunds.
     */
    public static function allRefunds($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, static::PATH_REFUNDS, $params, $opts);
    }
}
