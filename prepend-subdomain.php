<?php

/**
 * Plugin Name:       Prepend Subdomain
 * Plugin URI:        https://github.com/helsingborg-stad/prepend-subdomain
 * Description:       Filter through WP content and adds a subdomain in realtime.
 * Version:           1.0.0
 * Author:            Joel Bernerman
 * Author URI:        https://github.com/helsingborg-stad
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 */

// Protect agains direct file access
if (!defined('WPINC')) {
    die;
}

if (!defined('PREPEND_SUBDOMAIN')) {
    define('PREPEND_SUBDOMAIN', 'stage');
}

define('PREPEND_SUBDOMAIN_PATH', plugin_dir_path(__FILE__));
define('PREPEND_SUBDOMAIN_URL', plugins_url('', __FILE__));

require_once PREPEND_SUBDOMAIN_PATH . 'Public.php';

// Register the autoloader
require __DIR__ . '/vendor/autoload.php';

// Start application
new \PrependSubdomain\App();
