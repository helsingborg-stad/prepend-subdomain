<?php
namespace PrependSubdomain\Test;

use PrependSubdomain\App;
use Brain\Monkey\Functions;
use Mockery;

class AppTest extends PluginTestCase
{
    public function testAddFilter()
    {
        new App();

        self::assertNotFalse(has_filter('the_permalink', 'PrependSubdomain\App->prependSubdomain()'));
        self::assertNotFalse(has_filter('wp_get_attachment_url', 'PrependSubdomain\App->prependSubdomain()'));
        self::assertNotFalse(has_filter('wp_get_attachment_image_src', 'PrependSubdomain\App->prependSubdomain()'));
        self::assertNotFalse(has_filter('script_loader_src', 'PrependSubdomain\App->prependSubdomain()'));
        self::assertNotFalse(has_filter('style_loader_src', 'PrependSubdomain\App->prependSubdomain()'));
        self::assertNotFalse(has_filter('the_content', 'PrependSubdomain\App->prependSubdomain()'));
        self::assertNotFalse(has_filter('widget_text', 'PrependSubdomain\App->prependSubdomain()'));
        self::assertNotFalse(has_filter('acf/load_value', 'PrependSubdomain\App->prependSubdomain()'));
    }

    public function testGetDomainReplacement()
    {
        $App = Mockery::mock('PrependSubdomain\App')->makePartial();
        $App->shouldReceive('getSubdomainConstant')->andReturn('test');

        $content1 = 'https://helsingborg.se';
        $content2 = 'https://test.helsingborg.se';

        Functions\when('home_url')->justReturn('https://helsingborg.se');

        $expectedResult = [
            'originalHost' => 'https://helsingborg.se',
            'prependedHost' => 'https://test.helsingborg.se',
        ];

        $result1 = $App->getDomainReplacement($content1);
        $result2 = $App->getDomainReplacement($content2);

        $this->assertEquals($result1, $expectedResult);
        $this->assertEquals($result2, $expectedResult);
    }

    public function testPrependSubdomain()
    {
        $App = Mockery::mock('PrependSubdomain\App')->makePartial();
        $App->shouldReceive('getSubdomainConstant')->andReturn('test');

        $content1 = 'https://helsingborg.se';
        $content2 = 'https://test.helsingborg.se';

        Functions\when('home_url')->justReturn('https://helsingborg.se');

        $expectedResult = 'https://test.helsingborg.se';

        $result1 = $App->prependSubdomain($content1);
        $result2 = $App->prependSubdomain($content2);

        $this->assertEquals($result1, $expectedResult);
        $this->assertEquals($result2, $expectedResult);
    }
}
