<?php

namespace PrependSubdomain;

/**
 * Implements example command.
 */
class WPcli
{
    /**
     * Prepends subdomain all domains in selected tables and columns.
     *
     * ## OPTIONS
     *
     * <subdomain>
     * : The subdomain to prepend to your domains.
     *
     *
     * ## EXAMPLES
     *
     *     wp subdomain prepend stage
     *
     * @when after_wp_load
     */
    function __invoke($args, $assocArgs) {
        list($subdomain) = $args;

        $wpdb = $this->getWpdb();

        $blogs = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->base_prefix . 'blogs'));
        $sites = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->base_prefix . 'site'));

        if (strpos($sites[0]->domain, $subdomain . '.') !== false) {
            $question = 'Main site domain ' . $sites[0]->domain . ' already contains subdomain ' . $subdomain . '! Do you want to continue?';
            $this->confirm($question);
        }

        $wpdb->query($wpdb->prepare('UPDATE ' . $wpdb->base_prefix . 'site SET domain = CONCAT("' . $subdomain . '.", domain)'));
        $wpdb->query($wpdb->prepare('UPDATE ' . $wpdb->base_prefix . 'blogs SET domain = CONCAT("' . $subdomain . '.", domain)'));

        foreach ($blogs as $blog) {
            $optionsTable = $wpdb->base_prefix . $blog->blog_id . '_options';
            if ($blog->blog_id == 1) {
                $optionsTable =  $wpdb->base_prefix . 'options';
            }

            $wpdb->query($wpdb->prepare('UPDATE ' . $optionsTable . ' SET option_value = REPLACE(option_value, "http://", "https://") WHERE option_name = "siteurl"'));
            $wpdb->query($wpdb->prepare('UPDATE ' . $optionsTable . ' SET option_value = REPLACE(option_value, "http://", "https://") WHERE option_name = "home"'));

            $wpdb->query($wpdb->prepare('UPDATE ' . $optionsTable . ' SET option_value = REPLACE(option_value, "https://", "https://' . $subdomain . '.") WHERE option_name = "siteurl"'));
            $wpdb->query($wpdb->prepare('UPDATE ' . $optionsTable . ' SET option_value = REPLACE(option_value, "https://", "https://' . $subdomain . '.") WHERE option_name = "home"'));
        }
    }

    /**
     * Helper function for tests.
     */
    public function getWpdb()
    {
        global $wpdb;
        return $wpdb;
    }

    /**
     * Helper function for tests.
     */
    public function confirm($question)
    {
        \WP_CLI::confirm($question);
    }
}
