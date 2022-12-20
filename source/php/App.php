<?php

namespace PrependSubdomain;

class App
{
    public function __construct()
    {
        add_filter('the_permalink', array($this, 'prependSubdomain'), 800);
        add_filter('wp_get_attachment_url', array($this, 'prependSubdomain'), 800);
        add_filter('wp_get_attachment_image_src', array($this, 'prependSubdomain'), 800);
        add_filter('script_loader_src', array($this, 'prependSubdomain'), 800);
        add_filter('style_loader_src', array($this, 'prependSubdomain'), 800);
        add_filter('the_content', array($this, 'prependSubdomain'), 800);
        add_filter('widget_text', array($this, 'prependSubdomain'), 800);
        add_filter('acf/load_value', array($this, 'prependSubdomain'), 800);
        if ( defined( 'WP_CLI' ) && WP_CLI ) {
            \WP_CLI::add_command('prepend', \PrependSubdomain\WPcli::class);
        }
    }

    public function prependSubdomain($content)
    {
        $hosts = $this->getDomainReplacement(home_url('/'));
        return str_replace($hosts['originalHost'], $hosts['prependedHost'], $content);
    }

    public function getDomainReplacement($url)
    {
        $host = parse_url($url)['host'];
        $subdomain = $this->getSubdomainConstant();

        $originalHost = $host;
        if (strpos($host, $subdomain . '.') !== false) {
            $originalHost = str_replace($subdomain . '.', '', $host);
        }

        $newHost = $subdomain . '.' . $originalHost;

        return [
            'originalHost' => 'https://' . $originalHost,
            'prependedHost' => 'https://' . $newHost
        ];
    }

    /**
     * Helper function for not breaking tests.
     */
    public function getSubdomainConstant()
    {
        return PREPEND_SUBDOMAIN;
    }
}
