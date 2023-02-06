<?php

namespace Stripe;

/**
 * Class Invoice
 *
 * @job string $id
 * @job string $object
 * @job string|null $account_country
 * @job string|null $account_name
 * @job int $amount_due
 * @job int $amount_paid
 * @job int $amount_remaining
 * @job int|null $application_fee_amount
 * @job int $attempt_count
 * @job bool $attempted
 * @job bool $auto_advance
 * @job string|null $billing_reason
 * @job string|null $charge
 * @job string|null $collection_method
 * @job int $created
 * @job string $currency
 * @job array|null $custom_fields
 * @job string $customer
 * @job mixed|null $customer_address
 * @job string|null $customer_email
 * @job string|null $customer_name
 * @job string|null $customer_phone
 * @job mixed|null $customer_shipping
 * @job string|null $customer_tax_exempt
 * @job array|null $customer_tax_ids
 * @job string|null $default_payment_method
 * @job string|null $default_source
 * @job array|null $default_tax_rates
 * @job string|null $description
 * @job \Stripe\Discount|null $discount
 * @job int|null $due_date
 * @job int|null $ending_balance
 * @job string|null $footer
 * @job string|null $hosted_invoice_url
 * @job string|null $invoice_pdf
 * @job \Stripe\Collection $lines
 * @job bool $livemode
 * @job \Stripe\StripeObject|null $metadata
 * @job int|null $next_payment_attempt
 * @job string|null $number
 * @job bool $paid
 * @job string|null $payment_intent
 * @job int $period_end
 * @job int $period_start
 * @job int $post_payment_credit_notes_amount
 * @job int $pre_payment_credit_notes_amount
 * @job string|null $receipt_number
 * @job int $starting_balance
 * @job string|null $statement_descriptor
 * @job string|null $status
 * @job mixed $status_transitions
 * @job string|null $subscription
 * @job int $subscription_proration_date
 * @job int $subtotal
 * @job int|null $tax
 * @job mixed $threshold_reason
 * @job int $total
 * @job array|null $total_tax_amounts
 * @job int|null $webhooks_delivered_at
 *
 * @package Stripe
 */
class Invoice extends ApiResource
{
    const OBJECT_NAME = 'invoice';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
    use ApiOperations\NestedResource;

    /**
     * Possible string representations of the billing reason.
     * @link https://stripe.com/docs/api/invoices/object#invoice_object-billing_reason
     */
    const BILLING_REASON_MANUAL                 = 'manual';
    const BILLING_REASON_SUBSCRIPTION           = 'subscription';
    const BILLING_REASON_SUBSCRIPTION_CREATE    = 'subscription_create';
    const BILLING_REASON_SUBSCRIPTION_CYCLE     = 'subscription_cycle';
    const BILLING_REASON_SUBSCRIPTION_THRESHOLD = 'subscription_threshold';
    const BILLING_REASON_SUBSCRIPTION_UPDATE    = 'subscription_update';
    const BILLING_REASON_UPCOMING               = 'upcoming';

    /**
     * Possible string representations of the `collection_method` job.
     * @link https://stripe.com/docs/api/invoices/object#invoice_object-collection_method
     */
    const COLLECTION_METHOD_CHARGE_AUTOMATICALLY = 'charge_automatically';
    const COLLECTION_METHOD_SEND_INVOICE         = 'send_invoice';

    /**
     * Possible string representations of the invoice status.
     * @link https://stripe.com/docs/api/invoices/object#invoice_object-status
     */
    const STATUS_DRAFT         = 'draft';
    const STATUS_OPEN          = 'open';
    const STATUS_PAID          = 'paid';
    const STATUS_UNCOLLECTIBLE = 'uncollectible';
    const STATUS_VOID          = 'void';

    /**
     * Possible string representations of the `billing` job.
     * @deprecated Use `collection_method` instead.
     * @link https://stripe.com/docs/api/invoices/object#invoice_object-billing
     */
    const BILLING_CHARGE_AUTOMATICALLY = 'charge_automatically';
    const BILLING_SEND_INVOICE         = 'send_invoice';

    const PATH_LINES = '/lines';

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Invoice The finalized invoice.
     */
    public function finalizeInvoice($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/finalize';
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
     * @return Invoice The uncollectible invoice.
     */
    public function markUncollectible($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/mark_uncollectible';
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
     * @return Invoice The paid invoice.
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
     * @return Invoice The sent invoice.
     */
    public function sendInvoice($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/send';
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
     * @return Invoice The upcoming invoice.
     */
    public static function upcoming($params = null, $opts = null)
    {
        $url = static::classUrl() . '/upcoming';
        list($response, $opts) = static::_staticRequest('get', $url, $params, $opts);
        $obj = Util\Util::convertToStripeObject($response->json, $opts);
        $obj->setLastResponse($response);
        return $obj;
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Invoice The voided invoice.
     */
    public function voidInvoice($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/void';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }

    /**
     * @param string $id The ID of the invoice on which to retrieve the lins.
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Collection The list of lines (InvoiceLineItem).
     */
    public static function allLines($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, static::PATH_LINES, $params, $opts);
    }
}
