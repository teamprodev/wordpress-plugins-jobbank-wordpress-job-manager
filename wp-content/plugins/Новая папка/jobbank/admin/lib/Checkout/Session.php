<?php

namespace Stripe\Checkout;

/**
 * Class Session
 *
 * @job string $id
 * @job string $object
 * @job string $cancel_url
 * @job string|null $client_reference_id
 * @job string|null $customer
 * @job string|null $customer_email
 * @job mixed|null $display_items
 * @job bool $livemode
 * @job string|null $mode
 * @job string|null $payment_intent
 * @job string[] $payment_method_types
 * @job string|null $setup_intent
 * @job string|null $submit_type
 * @job string|null $subscription
 * @job string $success_url
 *
 * @package Stripe\Checkout
 */
class Session extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'checkout.session';

    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Retrieve;

    /**
     * Possible string representations of submit type.
     * @link https://stripe.com/docs/api/checkout/sessions/create#create_checkout_session-submit_type
     */
    const SUBMIT_TYPE_AUTO    = 'auto';
    const SUBMIT_TYPE_BOOK    = 'book';
    const SUBMIT_TYPE_DONATE  = 'donate';
    const SUBMIT_TYPE_PAY     = 'pay';
}
