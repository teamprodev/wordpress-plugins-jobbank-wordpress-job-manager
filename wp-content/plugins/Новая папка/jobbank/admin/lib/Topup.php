<?php

namespace Stripe;

/**
 * Class Topup
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job string|null $balance_transaction
 * @job int $created
 * @job string $currency
 * @job string|null $description
 * @job int|null $expected_availability_date
 * @job string|null $failure_code
 * @job string|null $failure_message
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job mixed $source
 * @job string|null $statement_descriptor
 * @job string $status
 * @job string|null $transfer_group
 *
 * @package Stripe
 */
class Topup extends ApiResource
{
    const OBJECT_NAME = 'topup';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    /**
     * Possible string representations of the status of the top-up.
     * @link https://stripe.com/docs/api/topups/object#topup_object-status
     */
    const STATUS_CANCELED  = 'canceled';
    const STATUS_FAILED    = 'failed';
    const STATUS_PENDING   = 'pending';
    const STATUS_REVERSED  = 'reversed';
    const STATUS_SUCCEEDED = 'succeeded';

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return Topup The canceled topup.
     */
    public function cancel($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/cancel';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);
        return $this;
    }
}
