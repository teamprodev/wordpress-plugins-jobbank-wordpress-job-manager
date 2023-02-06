<?php

namespace Stripe;

/**
 * Class Order
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job int|null $amount_returned
 * @job string|null $application
 * @job int|null $application_fee
 * @job string|null $charge
 * @job int $created
 * @job string $currency
 * @job string|null $customer
 * @job string|null $email
 * @job string $external_coupon_code
 * @job OrderItem[] $items
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job \Stripe\Collection|null $returns
 * @job string|null $selected_shipping_method
 * @job mixed|null $shipping
 * @job array|null $shipping_methods
 * @job string $status
 * @job mixed|null $status_transitions
 * @job int|null $updated
 * @job string $upstream_id
 *
 * @package Stripe
 */
class Order extends ApiResource
{
    const OBJECT_NAME = 'order';

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
     * @return Order The paid order.
     */
    public function pay($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/pay';
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
     * @return OrderReturn The newly created return.
     */
    public function returnOrder($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/returns';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        return Util\Util::convertToStripeObject($response, $opts);
    }
}
