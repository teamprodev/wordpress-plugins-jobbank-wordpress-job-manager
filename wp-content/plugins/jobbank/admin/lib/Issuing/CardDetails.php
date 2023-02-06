<?php

namespace Stripe\Issuing;

/**
 * Class CardDetails
 *
 * @job string $id
 * @job string $object
 * @job Card $card
 * @job string $cvc
 * @job int $exp_month
 * @job int $exp_year
 * @job string $number
 *
 * @package Stripe\Issuing
 */
class CardDetails extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'issuing.card_details';
}
