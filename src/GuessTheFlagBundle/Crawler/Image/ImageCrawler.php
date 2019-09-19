<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image;

use GuessTheFlagBundle\Crawler\Image\Strategy\WikiFlagCrawlerStrategy;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

class ImageCrawler
{
    private $imageDownloader;
    private $crawlerStrategy;
    private $logger;
    private $client;

    public function __construct(ImageDownloader $imageDownloader, WikiFlagCrawlerStrategy $crawlerStrategy, LoggerInterface $logger)
    {
        $this->imageDownloader = $imageDownloader;
        $this->crawlerStrategy = $crawlerStrategy;
        $this->logger = $logger;

        $this->client = new Client();
    }

    public function crawlPage(string $url): void
    {
        $html = $this->getUrlContents($url);

        $this->logger->info(sprintf('Started crawling page: %s', $url));

        $images = $this->crawlerStrategy->crawlImages($html);

        foreach ($images as $imageUrl) {
            $this->imageDownloader->downloadTo($imageUrl, __DIR__.'/../../../../web/images/guesstheflag/flags/');
            $this->logger->info(sprintf('Downloaded image from: %s', $imageUrl));
        }

        $this->logger->info(sprintf('Finished crawling. %s images where downloaded', count($images)));
    }

    protected function getUrlContents($url): string
    {
        return $this->client->get($url)->getBody()->getContents();
    }
}
