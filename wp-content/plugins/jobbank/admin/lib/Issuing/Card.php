<?php

namespace Stripe\Issuing;

/**
 * Class Card
 *
 * @job string $id
 * @job string $object
 * @job mixed $authorization_controls
 * @job string $brand
 * @job \Stripe\Issuing\Cardholder|null $cardholder
 * @job int $created
 * @job string $currency
 * @job int $exp_month
 * @job int $exp_year
 * @job string $last4
 * @job bool $livemode
 * @job \Stripe\StripeObject $metadata
 * @job string $name
 * @job mixed|null $pin
 * @job string|null $replacement_for
 * @job string|null $replacement_reason
 * @job mixed|null $shipping
 * @job string $status
 * @job string $type
 *
 * @package Stripe\Issuing
 */
class Card extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'issuing.card';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Retrieve;
    use \Stripe\ApiOperations\Update;

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return CardDetails The card details associated with that issuing card.
     */
    public function details($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/details';
        list($response, $opts) = $this->_request('get', $url, $params, $opts);
        $obj = \Stripe\Util\Util::convertToStripeObject($response, $opts);
        $obj->setLastResponse($response);
        return $obj;
    }
}
