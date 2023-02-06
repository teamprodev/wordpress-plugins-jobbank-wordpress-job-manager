<?php

namespace Stripe;

/**
 * Class PaymentMethod
 *
 * @job string $id
 * @job string $object
 * @job mixed $billing_details
 * @job mixed $card
 * @job mixed $card_present
 * @job int $created
 * @job string|null $customer
 * @job mixed|null $ideal
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job mixed|null $sepa_debit
 * @job string $type
 *
 * @package Stripe
 */
class PaymentMethod extends ApiResource
{
    const OBJECT_NAME = 'payment_method';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return PaymentMethod The attached payment method.
     */
    public function attach($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/attach';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return PaymentMethod The detached payment method.
     */
    public function detach($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/detach';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
