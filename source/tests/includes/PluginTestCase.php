<?php

namespace PrependSubdomain\Test;

use Brain\Monkey;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class PluginTestCase extends TestCase
{

    use MockeryPHPUnitIntegration;

    /**
     * Setup which calls \WP_Mock setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
        // A few common passthrough
        // 1. WordPress i18n functions
        Monkey\Functions\when('__')
            ->returnArg(1);
        Monkey\Functions\when('_e')
            ->returnArg(1);
        Monkey\Functions\when('_n')
            ->returnArg(1);
        Monkey\Functions\when('home_url')
            ->alias(fn ($v = '') => $this->homeUrl() . $v);
    }

    /**
     * Teardown which calls \WP_Mock tearDown
     *
     * @return void
     */
    public function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }
}
