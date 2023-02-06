<?php

namespace Stripe;

/**
 * Class BitcoinReceiver
 *
 * @deprecated Bitcoin receivers are deprecated. Please use the sources API instead.
 * @link https://stripe.com/docs/sources/bitcoin
 *
 * @job string $id
 * @job string $object
 * @job bool $active
 * @job int $amount
 * @job int $amount_received
 * @job int $bitcoin_amount
 * @job int $bitcoin_amount_received
 * @job string $bitcoin_uri
 * @job int $created
 * @job string $currency
 * @job string|null $customer
 * @job string|null $description
 * @job string|null $email
 * @job bool $filled
 * @job string $inbound_address
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string|null $payment
 * @job string|null $refund_address
 * @job mixed $transactions
 * @job bool $uncaptured_funds
 * @job bool|null $used_for_payment
 *
 * @package Stripe
 */
class BitcoinReceiver extends ApiResource
{
    const OBJECT_NAME = 'bitcoin_receiver';

    use ApiOperations\All;
    use ApiOperations\Retrieve;

    /**
     * @return string The class URL for this resource. It needs to be special
     *    cased because it doesn't fit into the standard resource pattern.
     */
    public static function classUrl()
    {
        return "/v1/bitcoin/receivers";
    }

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
            $parentExtn = urlencode(Util\Util::utf8($parent));
            $extn = urlencode(Util\Util::utf8($this['id']));
            return "$base/$parentExtn/$path/$extn";
        } else {
            $base = BitcoinReceiver::classUrl();
            $extn = urlencode(Util\Util::utf8($this['id']));
            return "$base/$extn";
        }
    }
}
