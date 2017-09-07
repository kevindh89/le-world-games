<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image;

use GuessTheFlagBundle\Crawler\Image\Strategy\ImageCrawlerStrategy;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class ImageCrawlerTest extends TestCase
{
    private $imageCrawler;
    private $imageDownloader;
    private $crawlerStrategy;
    private $logger;

    protected function setUp()
    {
        $this->imageDownloader = $this->getMockBuilder(ImageDownloader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->crawlerStrategy = $this->getMockBuilder(ImageCrawlerStrategy::class)
            ->getMock();

        $this->logger = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->imageCrawler = $this->getMockBuilder(ImageCrawler::class)
            ->setConstructorArgs([
                $this->imageDownloader,
                $this->crawlerStrategy,
                $this->logger,
            ])
            ->setMethods([
                'getUrlContents',
            ])
            ->getMock();
    }

    /**
     * @test
     */
    public function it_downloads_the_crawled_images()
    {
        $html = <<<'HTML'
<html>
<img src="https://www.google.nl/images/test.jpg"/>
<img src="https://www.google.nl/images/test.jpg"/>
<img src="https://www.google.nl/images/test.jpg"/>
</html>
HTML;
        $images = [
            'https://www.google.nl/images/test.jpg',
            'https://www.google.nl/images/test.jpg',
            'https://www.google.nl/images/test.jpg',
        ];

        $this->imageCrawler->expects($this->once())
            ->method('getUrlContents')
            ->willReturn($html);

        $this->crawlerStrategy->expects($this->once())
            ->method('crawlImages')
            ->with($html)
            ->willReturn($images);

        $this->imageDownloader->expects($this->exactly(3))
            ->method('downloadTo')
            ->with('https://www.google.nl/images/test.jpg', $this->stringEndsWith('../../../../web/images/guesstheflag/flags/'));

        $this->imageCrawler->crawlPage('https://www.google.nl/images_of_flags');
    }
}
