<?php

// Get around direct access blockers.
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/../../../');
}

define('PREPEND_SUBDOMAIN_PATH', __DIR__ . '/../../../');
define('PREPEND_SUBDOMAIN_URL', 'https://example.com/wp-content/plugins/' . 'prepend-subdomain');
define('PHPUNIT_RUNNING', 1);

// Register the autoloader
$loader = require __DIR__ . '/../../../vendor/autoload.php';
$loader->addPsr4('PrependSubdomain\\Test\\', __DIR__ . '/../php/');

require_once __DIR__ . '/PluginTestCase.php';
