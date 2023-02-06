<?php

namespace Stripe;

/**
 * Class TransferReversal
 *
 * @job string $id
 * @job string $object
 * @job int $amount
 * @job string $balance_transaction
 * @job int $created
 * @job string $currency
 * @job string $destination_payment_refund
 * @job StripeObject $metadata
 * @job string $source_refund
 * @job string $transfer
 *
 * @package Stripe
 */
class TransferReversal extends ApiResource
{
    const OBJECT_NAME = 'transfer_reversal';

    use ApiOperations\Update {
        save as protected _save;
    }

    /**
     * @return string The API URL for this Stripe transfer reversal.
     */
    public function instanceUrl()
    {
        $id = $this['id'];
        $transfer = $this['transfer'];
        if (!$id) {
            throw new Exception\UnexpectedValueException(
                "Could not determine which URL to request: " .
                "class instance has invalid ID: $id",
                null
            );
        }
        $id = Util\Util::utf8($id);
        $transfer = Util\Util::utf8($transfer);

        $base = Transfer::classUrl();
        $transferExtn = urlencode($transfer);
        $extn = urlencode($id);
        return "$base/$transferExtn/reversals/$extn";
    }

    /**
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return TransferReversal The saved reversal.
     */
    public function save($opts = null)
    {
        return $this->_save($opts);
    }
}
