<?php

namespace Stripe;

/**
 * Class Review
 *
 * @job string $id
 * @job string $object
 * @job string|null $billing_zip
 * @job string|null $charge
 * @job string|null $closed_reason
 * @job int $created
 * @job string|null $ip_address
 * @job mixed|null $ip_address_location
 * @job bool $livemode
 * @job bool $open
 * @job string $opened_reason
 * @job string $payment_intent
 * @job string $reason
 * @job mixed|null $session
 *
 * @package Stripe
 */
class Review extends ApiResource
{
    const OBJECT_NAME = 'review';

    use ApiOperations\All;
    use ApiOperations\Retrieve;

    /**
     * Possible string representations of the current, the opening or the closure reason of the review.
     * Not all of these enumeration apply to all of the ´reason´ fields. Please consult the Review object to
     * determine where these are apply.
     * @link https://stripe.com/docs/api/radar/reviews/object
     */
    const REASON_APPROVED          = 'approved';
    const REASON_DISPUTED          = 'disputed';
    const REASON_MANUAL            = 'manual';
    const REASON_REFUNDED          = 'refunded';
    const REASON_REFUNDED_AS_FRAUD = 'refunded_as_fraud';
    const REASON_RULE              = 'rule';

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Review The approved review.
     */
    public function approve($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/approve';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
