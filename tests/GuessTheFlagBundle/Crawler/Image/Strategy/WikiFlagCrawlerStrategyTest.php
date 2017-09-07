<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image\Strategy;

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class WikiFlagCrawlerStrategyTest extends TestCase
{
    /**
     * @test
     */
    public function it_crawls_images_with_class_thumbborder_from_the_html()
    {
        $html = <<<'HTML'
<html><body>
<img class="thumbborder" src="//www.google.nl/images/test1.jpg"/>
<img src="//www.google.nl/images/test2.jpg"/>
<img class="thumbborder" src="//www.google.nl/images/test3.jpg"/>
</body></html>
HTML;

        $images = [
            'https://www.google.nl/images/test1.jpg',
            'https://www.google.nl/images/test3.jpg',
        ];

        $crawler = new WikiFlagCrawlerStrategy();
        $result = $crawler->crawlImages($html);

        $this->assertSame($images, $result);
    }
}
