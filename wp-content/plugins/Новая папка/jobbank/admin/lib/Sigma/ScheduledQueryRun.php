<?php

namespace Stripe\Sigma;

/**
 * Class ScheduledQueryRun
 *
 * @job string $id
 * @job string $object
 * @job int $created
 * @job int $data_load_time
 * @job mixed $error
 * @job \Stripe\File|null $file
 * @job bool $livemode
 * @job int $result_available_until
 * @job string $sql
 * @job string $status
 * @job string $title
 *
 * @package Stripe\Sigma
 */
class ScheduledQueryRun extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'scheduled_query_run';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Retrieve;

    public static function classUrl()
    {
        return "/v1/sigma/scheduled_query_runs";
    }
}
