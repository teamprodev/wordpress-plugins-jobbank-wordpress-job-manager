<?php

namespace Stripe\Reporting;

/**
 * Class ReportType
 *
 * @job string $id
 * @job string $object
 * @job int $data_available_end
 * @job int $data_available_start
 * @job string[]|null $default_columns
 * @job string $name
 * @job int $updated
 * @job int $version
 *
 * @package Stripe\Reporting
 */
class ReportType extends \Stripe\ApiResource
{
    const OBJECT_NAME = 'reporting.report_type';

    use \Stripe\ApiOperations\All;
    use \Stripe\ApiOperations\Retrieve;
}
