<?php

namespace Stripe;

/**
 * Class Subscription
 *
 * @job string $id
 * @job string $object
 * @job float|null $application_fee_percent
 * @job int $billing_cycle_anchor
 * @job mixed|null $billing_thresholds
 * @job int|null $cancel_at
 * @job bool $cancel_at_period_end
 * @job int|null $canceled_at
 * @job string|null $collection_method
 * @job int $created
 * @job int $current_period_end
 * @job int $current_period_start
 * @job string $customer
 * @job int|null $days_until_due
 * @job string|null $default_payment_method
 * @job string|null $default_source
 * @job array|null $default_tax_rates
 * @job \Stripe\Discount|null $discount
 * @job int|null $ended_at
 * @job mixed $invoice_customer_balance_settings
 * @job \Stripe\Collection $items
 * @job string|null $latest_invoice
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job int|null $next_pending_invoice_item_invoice
 * @job mixed|null $pending_invoice_item_interval
 * @job string|null $pending_setup_intent
 * @job \Stripe\Plan|null $plan
 * @job int|null $quantity
 * @job string|null $schedule
 * @job int $start_date
 * @job string $status
 * @job float|null $tax_percent
 * @job int|null $trial_end
 * @job int|null $trial_start
 *
 * @package Stripe
 */
class Subscription extends ApiResource
{
    const OBJECT_NAME = 'subscription';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete {
        delete as protected _delete;
    }
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    /**
     * These constants are possible representations of the status field.
     *
     * @link https://stripe.com/docs/api#subscription_object-status
     */
    const STATUS_ACTIVE             = 'active';
    const STATUS_CANCELED           = 'canceled';
    const STATUS_PAST_DUE           = 'past_due';
    const STATUS_TRIALING           = 'trialing';
    const STATUS_UNPAID             = 'unpaid';
    const STATUS_INCOMPLETE         = 'incomplete';
    const STATUS_INCOMPLETE_EXPIRED = 'incomplete_expired';

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

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Subscription The deleted subscription.
     */
    public function cancel($params = null, $opts = null)
    {
        return $this->_delete($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Subscription The updated subscription.
     */
    public function deleteDiscount($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/discount';
        list($response, $opts) = $this->_request('delete', $url, $params, $opts);
        $this->refreshFrom(['discount' => null], $opts, true);
    }
}
