<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image\Strategy;

use Doctrine\ORM\EntityManager;
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
<a class="image"><img class="thumbborder" src="//www.google.nl/images/test1.jpg"/></a>
<a class="non-image"><img src="//www.google.nl/images/test2.jpg"/></a>
<a class="image"><img class="thumbborder" src="//www.google.nl/images/test3.jpg"/></a>
</body></html>
HTML;

        $images = [
            'https://www.google.nl/images/test1.jpg',
            'https://www.google.nl/images/test3.jpg',
        ];

        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $em->expects($this->any())
            ->method('persist');
        $em->expects($this->once())
            ->method('flush');

        $crawler = new WikiFlagCrawlerStrategy($em);
        $result = $crawler->crawlImages($html);

        $this->assertSame($images, $result);
    }
}
