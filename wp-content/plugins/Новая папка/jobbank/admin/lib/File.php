<?php

namespace Stripe;

/**
 * Class File
 *
 * @job string $id
 * @job string $object
 * @job int $created
 * @job string|null $filename
 * @job \Stripe\Collection|null $links
 * @job string $purpose
 * @job int $size
 * @job string|null $title
 * @job string|null $type
 * @job string|null $url
 *
 * @package Stripe
 */
class File extends ApiResource
{
    // This resource can have two different object names. In latter API
    // versions, only `file` is used, but since stripe-php may be used with
    // any API version, we need to support deserializing the older
    // `file_upload` object into the same class.
    const OBJECT_NAME = 'file';
    const OBJECT_NAME_ALT = "file_upload";

    use ApiOperations\All;
    use ApiOperations\Create {
        create as protected _create;
    }
    use ApiOperations\Retrieve;

    public static function classUrl()
    {
        return '/v1/files';
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @throws \Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \Stripe\File The created resource.
     */
    public static function create($params = null, $options = null)
    {
        $opts = \Stripe\Util\RequestOptions::parse($options);
        if (is_null($opts->apiBase)) {
            $opts->apiBase = Stripe::$apiUploadBase;
        }
        // Manually flatten params, otherwise curl's multipart encoder will
        // choke on nested arrays.
        $flatParams = array_column(\Stripe\Util\Util::flattenParams($params), 1, 0);
        return static::_create($flatParams, $opts);
    }
}
