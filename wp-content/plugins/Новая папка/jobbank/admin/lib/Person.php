<?php

namespace Stripe;

/**
 * Class Person
 *
 * @package Stripe
 *
 * @job string $id
 * @job string $object
 * @job string $account
 * @job mixed $address
 * @job mixed $address_kana
 * @job mixed $address_kanji
 * @job int $created
 * @job bool $deleted
 * @job mixed $dob
 * @job string $email
 * @job string $first_name
 * @job string $first_name_kana
 * @job string $first_name_kanji
 * @job string $gender
 * @job bool $id_number_provided
 * @job string $last_name
 * @job string $last_name_kana
 * @job string $last_name_kanji
 * @job string $maiden_name
 * @job StripeObject $metadata
 * @job string $phone
 * @job mixed $relationship
 * @job mixed $requirements
 * @job bool $ssn_last_4_provided
 * @job mixed $verification
 */
class Person extends ApiResource
{
    const OBJECT_NAME = 'person';

    use ApiOperations\Delete;
    use ApiOperations\Update;

    /**
     * Possible string representations of a person's gender.
     * @link https://stripe.com/docs/api/persons/object#person_object-gender
     */
    const GENDER_MALE   = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * Possible string representations of a person's verification status.
     * @link https://stripe.com/docs/api/persons/object#person_object-verification-status
     */
    const VERIFICATION_STATUS_PENDING    = 'pending';
    const VERIFICATION_STATUS_UNVERIFIED = 'unverified';
    const VERIFICATION_STATUS_VERIFIED   = 'verified';

    /**
     * @return string The API URL for this Stripe account reversal.
     */
    public function instanceUrl()
    {
        $id = $this['id'];
        $account = $this['account'];
        if (!$id) {
            throw new Exception\UnexpectedValueException(
                "Could not determine which URL to request: " .
                "class instance has invalid ID: $id",
                null
            );
        }
        $id = Util\Util::utf8($id);
        $account = Util\Util::utf8($account);

        $base = Account::classUrl();
        $accountExtn = urlencode($account);
        $extn = urlencode($id);
        return "$base/$accountExtn/persons/$extn";
    }

    /**
     * @param array|string $_id
     * @param array|string|null $_opts
     *
     * @throws \Stripe\Exception\BadMethodCallException
     */
    public static function retrieve($_id, $_opts = null)
    {
        $msg = "Persons cannot be retrieved without an account ID. Retrieve " .
               "a person using `Account::retrievePerson('account_id', " .
               "'person_id')`.";
        throw new Exception\BadMethodCallException($msg, null);
    }

    /**
     * @param string $_id
     * @param array|null $_params
     * @param array|string|null $_options
     *
     * @throws \Stripe\Exception\BadMethodCallException
     */
    public static function update($_id, $_params = null, $_options = null)
    {
        $msg = "Persons cannot be updated without an account ID. Update " .
               "a person using `Account::updatePerson('account_id', " .
               "'person_id', \$updateParams)`.";
        throw new Exception\BadMethodCallException($msg, null);
    }
}
