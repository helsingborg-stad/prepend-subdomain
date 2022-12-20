<?php
namespace PrependSubdomain\Test;

use PrependSubdomain\WPcli;
use Brain\Monkey\Functions;
use Mockery;

class WPcliTest extends PluginTestCase
{
    public function testSubdomain()
    {
        $mock = \Mockery::mock('alias:WP_CLI');

        $wpdb = \Mockery::mock( '\wpdb' );

        $wpdb->base_prefix = 'test_';

        $testResultRow1 = new \StdClass;
        $testResultRow2 = new \StdClass;
        $testResultRow1->domain = 'test.com';
        $testResultRow1->blog_id = 1;
        $testResultRow2->domain = 'blog.test.com';
        $testResultRow2->blog_id = 1;


        $testResult = [$testResultRow1, $testResultRow2];

        $wpdb->shouldReceive('get_results')->twice()->andReturn($testResult);
        $wpdb->shouldReceive('prepare')->times(12);

        $wpdb->shouldReceive('query')->times(10);

        $wpCli = Mockery::mock('PrependSubdomain\WPcli')->makePartial();

        $wpCli->shouldReceive('getWpdb')->andReturn($wpdb);
        $wpCli->shouldReceive('confirm');

        $wpCli->__invoke('test', 'test');
    }
}
