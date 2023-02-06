<?php

namespace Stripe\Reporting;

/**
 * Class ReportRun
 *
 * @job string $id
 * @job string $object
 * @job int $created
 * @job string|null $error
 * @job bool $livemode
 * @job mixed $parameters
 * @job string $report_type
 * @job mixed|null $result
 * @job string $status
 * @job int|null $succeeded_at
 *
 * @package Stripe\Reporting
 */
class ReportRun extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'reporting.report_run';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Create;
    use \Stripe\ApiOperations\Retrieve;
}
