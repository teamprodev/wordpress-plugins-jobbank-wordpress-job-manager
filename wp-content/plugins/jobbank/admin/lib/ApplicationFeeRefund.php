<?php

namespace Stripe;

/**
 * Class ApplicationFeeRefund
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job string $balance_transaction
 * @job int $created
 * @job string $currency
 * @job string $fee
 * @job StripeObject $metadata
 *
 * @package Stripe
 */
class ApplicationFeeRefund extends ApiResource
{
    const OBJECT_NAME = 'fee_refund';

    use ApiOperations\Update {
        save as protected _save;
    }

    /**
     * @return string The API URL for this Stripe refund.
     */
    public function instanceUrl()
    {
        $id = $this['id'];
        $fee = $this['fee'];
        if (!$id) {
            throw new Exception\UnexpectedValueException(
                "Could not determine which URL to request: " .
                "class instance has invalid ID: $id",
                null
            );
        }
        $id = Util\Util::utf8($id);
        $fee = Util\Util::utf8($fee);

        $base = ApplicationFee::classUrl();
        $feeExtn = urlencode($fee);
        $extn = urlencode($id);
        return "$base/$feeExtn/refunds/$extn";
    }

    /**
     * @param array|string|null $opts
     *
     * @return ApplicationFeeRefund The saved refund.
     */
    public function save($opts = null)
    {
        return $this->_save($opts);
    }
}
