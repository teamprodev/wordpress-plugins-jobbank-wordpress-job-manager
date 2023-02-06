<?php

namespace Stripe;

/**
 * Class SubscriptionSchedule
 *
 * @job string $id
 * @job string $object
 * @job mixed|null $billing_thresholds
 * @job int|null $canceled_at
 * @job string|null $collection_method
 * @job int|null $completed_at
 * @job int $created
 * @job mixed|null $current_phase
 * @job string $customer
 * @job string|null $default_payment_method
 * @job string $end_behavior
 * @job mixed|null $invoice_settings
 * @job bool $livemode
 * @job \Stripe\StripeObject|null $metadata
 * @job mixed $phases
 * @job int|null $released_at
 * @job string|null $released_subscription
 * @job mixed|null $renewal_interval
 * @job string $status
 * @job string|null $subscription
 *
 * @package Stripe
 */
class SubscriptionSchedule extends ApiResource
{
    const OBJECT_NAME = 'subscription_schedule';

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
     * @return SubscriptionSchedule The canceled subscription schedule.
     */
    public function cancel($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/cancel';
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
     * @return SubscriptionSchedule The released subscription schedule.
     */
    public function release($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/release';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
