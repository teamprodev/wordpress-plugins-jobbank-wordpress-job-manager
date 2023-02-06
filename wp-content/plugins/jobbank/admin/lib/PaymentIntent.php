<?php

namespace Stripe;

/**
 * Class PaymentIntent
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job int $amount_capturable
 * @job int $amount_received
 * @job string|null $application
 * @job int|null $application_fee_amount
 * @job int|null $canceled_at
 * @job string|null $cancellation_reason
 * @job string $capture_method
 * @job \Stripe\Collection $charges
 * @job string|null $client_secret
 * @job string $confirmation_method
 * @job int $created
 * @job string $currency
 * @job string|null $customer
 * @job string|null $description
 * @job string|null $invoice
 * @job mixed|null $last_payment_error
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job mixed|null $next_action
 * @job string|null $on_behalf_of
 * @job string|null $payment_method
 * @job mixed|null $payment_method_options
 * @job string[] $payment_method_types
 * @job string|null $receipt_email
 * @job string|null $review
 * @job string|null $setup_future_usage
 * @job mixed|null $shipping
 * @job string|null $source
 * @job string|null $statement_descriptor
 * @job string|null $statement_descriptor_suffix
 * @job string $status
 * @job mixed|null $transfer_data
 * @job string|null $transfer_group
 *
 * @package Stripe
 */
class PaymentIntent extends ApiResource
{
    const OBJECT_NAME = 'payment_intent';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    /**
     * These constants are possible representations of the status field.
     *
     * @link https://stripe.com/docs/api/payment_intents/object#payment_intent_object-status
     */
    const STATUS_CANCELED                = 'canceled';
    const STATUS_PROCESSING              = 'processing';
    const STATUS_REQUIRES_ACTION         = 'requires_action';
    const STATUS_REQUIRES_CAPTURE        = 'requires_capture';
    const STATUS_REQUIRES_CONFIRMATION   = 'requires_confirmation';
    const STATUS_REQUIRES_PAYMENT_METHOD = 'requires_payment_method';
    const STATUS_SUCCEEDED               = 'succeeded';

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return PaymentIntent The canceled payment intent.
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
     * @return PaymentIntent The captured payment intent.
     */
    public function capture($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/capture';
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
     * @return PaymentIntent The confirmed payment intent.
     */
    public function confirm($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/confirm';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
