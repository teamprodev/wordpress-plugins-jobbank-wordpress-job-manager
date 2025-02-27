<?php

namespace Stripe;

/**
 * Class BankAccount
 *
 * @job string $id
 * @job string $object
 * @job string|null $account
 * @job string|null $account_holder_name
 * @job string|null $account_holder_type
 * @job string|null $bank_name
 * @job string $country
 * @job string|null $currency
 * @job string|null $customer
 * @job bool|null $default_for_currency
 * @job string|null $fingerprint
 * @job string $last4
 * @job \Stripe\StripeObject|null $metadata
 * @job string|null $routing_number
 * @job string $status
 *
 * @package Stripe
 */
class BankAccount extends ApiResource
{
    const OBJECT_NAME = 'bank_account';

    use ApiOperations\Delete;
    use ApiOperations\Update;

    /**
     * Possible string representations of the bank verification status.
     * @link https://stripe.com/docs/api/external_account_bank_accounts/object#account_bank_account_object-status
     */
    const STATUS_NEW                 = 'new';
    const STATUS_VALIDATED           = 'validated';
    const STATUS_VERIFIED            = 'verified';
    const STATUS_VERIFICATION_FAILED = 'verification_failed';
    const STATUS_ERRORED             = 'errored';

    /**
     * @return string The instance URL for this resource. It needs to be special
     *    cased because it doesn't fit into the standard resource pattern.
     */
    public function instanceUrl()
    {
        if ($this['customer']) {
            $base = Customer::classUrl();
            $parent = $this['customer'];
            $path = 'sources';
        } elseif ($this['account']) {
            $base = Account::classUrl();
            $parent = $this['account'];
            $path = 'external_accounts';
        } else {
            $msg = "Bank accounts cannot be accessed without a customer ID or account ID.";
            throw new Exception\UnexpectedValueException($msg, null);
        }
        $parentExtn = urlencode(Util\Util::utf8($parent));
        $extn = urlencode(Util\Util::utf8($this['id']));
        return "$base/$parentExtn/$path/$extn";
    }

    /**
     * @param array|string $_id
     * @param array|string|null $_opts
     *
     * @throws \Stripe\Exception\BadMethodCallException
     */
    public static function retrieve($_id, $_opts = null)
    {
        $msg = "Bank accounts cannot be retrieved without a customer ID or " .
               "an account ID. Retrieve a bank account using " .
               "`Customer::retrieveSource('customer_id', " .
               "'bank_account_id')` or `Account::retrieveExternalAccount(" .
               "'account_id', 'bank_account_id')`.";
        throw new Exception\BadMethodCallException($msg, null);
    }

    /**
     * @param string $_id
     * @param array|null $_params
     * @param array|string|null $_options
     *
     * @throws \Stripe\Exception\BadMethodCallException
     */
    public static function update($_id, $_params = null, $_options = null)
    {
        $msg = "Bank accounts cannot be updated without a customer ID or an " .
               "account ID. Update a bank account using " .
               "`Customer::updateSource('customer_id', 'bank_account_id', " .
               "\$updateParams)` or `Account::updateExternalAccount(" .
               "'account_id', 'bank_account_id', \$updateParams)`.";
        throw new Exception\BadMethodCallException($msg, null);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return BankAccount The verified bank account.
     */
    public function verify($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/verify';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
