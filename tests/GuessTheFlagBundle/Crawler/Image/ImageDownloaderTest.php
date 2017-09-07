<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image;

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class ImageDownloaderTest extends TestCase
{
    /**
     * @test
     */
    public function it_downloads_the_file_to_the_folder()
    {
        $imageDownloader = $this->getMockBuilder(ImageDownloader::class)
            ->setMethods([
                'download',
            ])
            ->getMock();

        $imageDownloader->expects($this->once())
            ->method('download')
            ->with('https://www.google.nl/test.jpg', './flags/test.jpg');

        $imageDownloader->downloadTo('https://www.google.nl/test.jpg', './flags/');
    }
}
