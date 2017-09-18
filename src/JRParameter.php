<?php

declare(strict_types=1);

/*
 * Jasper report integration for PHP
 *
 * @link      https://github.com/belgattitude/soluble-jasper
 * @author    Vanvelthem Sébastien
 * @copyright Copyright (c) 2017 Vanvelthem Sébastien
 * @license   MIT
 */

namespace Soluble\Jasper;

interface JRParameter
{
    const REPORT_CLASS_LOADER = 'REPORT_CLASS_LOADER';
    const REPORT_CONNECTION = 'REPORT_CONNECTION';
    const REPORT_CONTEXT = 'REPORT_CONTEXT';
    const REPORT_DATA_SOURCE = 'REPORT_DATA_SOURCE';
    const REPORT_FILE_RESOLVER = 'REPORT_FILE_RESOLVER';
    const REPORT_FORMAT_FACTORY = 'REPORT_FORMAT_FACTORY';
    const REPORT_LOCALE = 'REPORT_LOCALE';
    const REPORT_RESOURCE_BUNDLE = 'REPORT_RESOURCE_BUNDLE';
    const REPORT_TEMPLATES = 'REPORT_TEMPLATES';
    const REPORT_TIME_ZONE = 'REPORT_TIME_ZONE';
    const REPORT_VIRTUALIZER = 'REPORT_VIRTUALIZER';
}
