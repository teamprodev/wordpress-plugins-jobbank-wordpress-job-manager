<?php

namespace Stripe\Issuing;

/**
 * Class Authorization
 *
 * @job string $id
 * @job string $object
 * @job bool $approved
 * @job string $authorization_method
 * @job int $authorized_amount
 * @job string $authorized_currency
 * @job \Stripe\Collection $balance_transactions
 * @job Card $card
 * @job string|null $cardholder
 * @job int $created
 * @job int $held_amount
 * @job string $held_currency
 * @job bool $is_held_amount_controllable
 * @job bool $livemode
 * @job mixed $merchant_data
 * @job \Stripe\StripeObject $metadata
 * @job int $pending_authorized_amount
 * @job int $pending_held_amount
 * @job mixed $request_history
 * @job string $status
 * @job array $transactions
 * @job mixed $verification_data
 *
 * @package Stripe\Issuing
 */
class Authorization extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'issuing.authorization';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Retrieve;
    use \Stripe\ApiOperations\Update;

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Authorization The approved authorization.
     */
    public function approve($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/approve';
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
     * @return Authorization The declined authorization.
     */
    public function decline($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/decline';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
