<?php

namespace Stripe;

/**
 * Class Refund
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job string|null $balance_transaction
 * @job string|null $charge
 * @job int $created
 * @job string $currency
 * @job string $description
 * @job string $failure_balance_transaction
 * @job string $failure_reason
 * @job \Stripe\StripeObject $metadata
 * @job string|null $reason
 * @job string|null $receipt_number
 * @job string|null $source_transfer_reversal
 * @job string|null $status
 * @job string|null $transfer_reversal
 *
 * @package Stripe
 */
class Refund extends ApiResource
{
    const OBJECT_NAME = 'refund';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    /**
     * Possible string representations of the failure reason.
     * @link https://stripe.com/docs/api/refunds/object#refund_object-failure_reason
     */
    const FAILURE_REASON                     = 'expired_or_canceled_card';
    const FAILURE_REASON_LOST_OR_STOLEN_CARD = 'lost_or_stolen_card';
    const FAILURE_REASON_UNKNOWN             = 'unknown';

    /**
     * Possible string representations of the refund reason.
     * @link https://stripe.com/docs/api/refunds/object#refund_object-reason
     */
    const REASON_DUPLICATE             = 'duplicate';
    const REASON_FRAUDULENT            = 'fraudulent';
    const REASON_REQUESTED_BY_CUSTOMER = 'requested_by_customer';

    /**
     * Possible string representations of the refund status.
     * @link https://stripe.com/docs/api/refunds/object#refund_object-status
     */
    const STATUS_CANCELED  = 'canceled';
    const STATUS_FAILED    = 'failed';
    const STATUS_PENDING   = 'pending';
    const STATUS_SUCCEEDED = 'succeeded';
}
