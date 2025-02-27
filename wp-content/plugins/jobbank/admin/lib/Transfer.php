<?php

namespace Stripe;

/**
 * Class Transfer
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job int $amount_reversed
 * @job string|null $balance_transaction
 * @job int $created
 * @job string $currency
 * @job string|null $description
 * @job string|null $destination
 * @job string $destination_payment
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job \Stripe\Collection $reversals
 * @job bool $reversed
 * @job string|null $source_transaction
 * @job string|null $source_type
 * @job string|null $transfer_group
 *
 * @package Stripe
 */
class Transfer extends ApiResource
{
    const OBJECT_NAME = 'transfer';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\NestedResource;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    const PATH_REVERSALS = '/reversals';

    /**
     * Possible string representations of the source type of the transfer.
     * @link https://stripe.com/docs/api/transfers/object#transfer_object-source_type
     */
    const SOURCE_TYPE_ALIPAY_ACCOUNT = 'alipay_account';
    const SOURCE_TYPE_BANK_ACCOUNT   = 'bank_account';
    const SOURCE_TYPE_CARD           = 'card';
    const SOURCE_TYPE_FINANCING      = 'financing';

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Transfer The canceled transfer.
     */
    public function cancel($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/cancel';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }

    /**
     * @param string $id The ID of the transfer on which to create the transfer reversal.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return TransferReversal
     */
    public static function createReversal($id, $params = null, $opts = null)
    {
        return self::_createNestedResource($id, static::PATH_REVERSALS, $params, $opts);
    }

    /**
     * @param string $id The ID of the transfer to which the transfer reversal belongs.
     * @param string $reversalId The ID of the transfer reversal to retrieve.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return TransferReversal
     */
    public static function retrieveReversal($id, $reversalId, $params = null, $opts = null)
    {
        return self::_retrieveNestedResource($id, static::PATH_REVERSALS, $reversalId, $params, $opts);
    }

    /**
     * @param string $id The ID of the transfer to which the transfer reversal belongs.
     * @param string $reversalId The ID of the transfer reversal to update.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return TransferReversal
     */
    public static function updateReversal($id, $reversalId, $params = null, $opts = null)
    {
        return self::_updateNestedResource($id, static::PATH_REVERSALS, $reversalId, $params, $opts);
    }

    /**
     * @param string $id The ID of the transfer on which to retrieve the transfer reversals.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Collection The list of transfer reversals.
     */
    public static function allReversals($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, static::PATH_REVERSALS, $params, $opts);
    }
}
