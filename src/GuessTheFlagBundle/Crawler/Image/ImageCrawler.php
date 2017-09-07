<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image;

use GuessTheFlagBundle\Crawler\Image\Strategy\ImageCrawlerStrategy;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ImageCrawler
{
    private $imageDownloader;
    private $crawlerStrategy;
    private $logger;
    private $client;

    public function __construct(ImageDownloader $imageDownloader, ImageCrawlerStrategy $crawlerStrategy, LoggerInterface $logger = null)
    {
        $this->imageDownloader = $imageDownloader;
        $this->crawlerStrategy = $crawlerStrategy;
        $this->logger = $logger ?: new NullLogger();
        $this->client = new Client();
    }

    public function crawlPage(string $url): void
    {
        $html = $this->getUrlContents($url);
        $this->logger->info('Started crawling page: '.$url);

        $images = $this->crawlerStrategy->crawlImages($html);

        foreach ($images as $imageUrl) {
            $this->imageDownloader->downloadTo($imageUrl, __DIR__.'/../../../../web/images/guesstheflag/flags/');
            $this->logger->info('Downloaded image from: '.$imageUrl);
        }

        $this->logger->info('Finished crawling. '.count($images).' images where downloaded');
    }

    protected function getUrlContents($url): string
    {
        return $this->client->get($url)->getBody()->getContents();
    }
}
