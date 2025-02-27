<?php

namespace Stripe;

/**
 * Class Customer
 *
 * @job string $id
 * @job string $object
 * @job mixed|null $address
 * @job int $balance
 * @job int $created
 * @job string|null $currency
 * @job string|null $default_source
 * @job bool|null $delinquent
 * @job string|null $description
 * @job \Stripe\Discount|null $discount
 * @job string|null $email
 * @job string|null $invoice_prefix
 * @job mixed $invoice_settings
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string|null $name
 * @job string|null $phone
 * @job string[]|null $preferred_locales
 * @job mixed|null $shipping
 * @job \Stripe\Collection $sources
 * @job \Stripe\Collection $subscriptions
 * @job string|null $tax_exempt
 * @job \Stripe\Collection $tax_ids
 *
 * @package Stripe
 */
class Customer extends ApiResource
{
    const OBJECT_NAME = 'customer';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\NestedResource;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    /**
     * Possible string representations of the customer's type of tax exemption.
     * @link https://stripe.com/docs/api/customers/object#customer_object-tax_exempt
     */
    const TAX_EXEMPT_NONE    = 'none';
    const TAX_EXEMPT_EXEMPT  = 'exempt';
    const TAX_EXEMPT_REVERSE = 'reverse';

    public static function getSavedNestedResources()
    {
        static $savedNestedResources = null;
        if ($savedNestedResources === null) {
            $savedNestedResources = new Util\Set([
                'source',
            ]);
        }
        return $savedNestedResources;
    }

    const PATH_BALANCE_TRANSACTIONS = '/balance_transactions';
    const PATH_SOURCES = '/sources';
    const PATH_TAX_IDS = '/tax_ids';

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return Customer The updated customer.
     */
    public function deleteDiscount($params = null, $options = null)
    {
        $url = $this->instanceUrl() . '/discount';
        list($response, $opts) = $this->_request('delete', $url, $params, $options);
        $this->refreshFrom(['discount' => null], $opts, true);
    }

    /**
     * @param string $id The ID of the customer on which to create the source.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return ApiResource
     */
    public static function createSource($id, $params = null, $opts = null)
    {
        return self::_createNestedResource($id, static::PATH_SOURCES, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer to which the source belongs.
     * @param string $sourceId The ID of the source to retrieve.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return ApiResource
     */
    public static function retrieveSource($id, $sourceId, $params = null, $opts = null)
    {
        return self::_retrieveNestedResource($id, static::PATH_SOURCES, $sourceId, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer to which the source belongs.
     * @param string $sourceId The ID of the source to update.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return ApiResource
     */
    public static function updateSource($id, $sourceId, $params = null, $opts = null)
    {
        return self::_updateNestedResource($id, static::PATH_SOURCES, $sourceId, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer to which the source belongs.
     * @param string $sourceId The ID of the source to delete.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return ApiResource
     */
    public static function deleteSource($id, $sourceId, $params = null, $opts = null)
    {
        return self::_deleteNestedResource($id, static::PATH_SOURCES, $sourceId, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer on which to retrieve the sources.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Collection The list of sources.
     */
    public static function allSources($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, static::PATH_SOURCES, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer on which to create the tax id.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return TaxId
     */
    public static function createTaxId($id, $params = null, $opts = null)
    {
        return self::_createNestedResource($id, static::PATH_TAX_IDS, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer to which the tax id belongs.
     * @param string $taxIdId The ID of the tax id to retrieve.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return TaxId
     */
    public static function retrieveTaxId($id, $taxIdId, $params = null, $opts = null)
    {
        return self::_retrieveNestedResource($id, static::PATH_TAX_IDS, $taxIdId, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer to which the tax id belongs.
     * @param string $taxIdId The ID of the tax id to delete.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return TaxId
     */
    public static function deleteTaxId($id, $taxIdId, $params = null, $opts = null)
    {
        return self::_deleteNestedResource($id, static::PATH_TAX_IDS, $taxIdId, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer on which to retrieve the tax ids.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Collection The list of tax ids.
     */
    public static function allTaxIds($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, static::PATH_TAX_IDS, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer on which to create the balance transaction.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return BalanceTransaction
     */
    public static function createBalanceTransaction($id, $params = null, $opts = null)
    {
        return self::_createNestedResource($id, static::PATH_BALANCE_TRANSACTIONS, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer to which the balance transaction belongs.
     * @param string $balanceTransactionId The ID of the balance transaction to retrieve.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return BalanceTransaction
     */
    public static function retrieveBalanceTransaction($id, $balanceTransactionId, $params = null, $opts = null)
    {
        return self::_retrieveNestedResource($id, static::PATH_BALANCE_TRANSACTIONS, $balanceTransactionId, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer to which the balance transaction belongs.
     * @param string $balanceTransactionId The ID of the balance transaction to update.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return BalanceTransaction
     */
    public static function updateBalanceTransaction($id, $balanceTransactionId, $params = null, $opts = null)
    {
        return self::_updateNestedResource($id, static::PATH_BALANCE_TRANSACTIONS, $balanceTransactionId, $params, $opts);
    }

    /**
     * @param string $id The ID of the customer on which to retrieve the balance transactions.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Collection The list of balance transactions.
     */
    public static function allBalanceTransactions($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, static::PATH_BALANCE_TRANSACTIONS, $params, $opts);
    }
}
