<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image\Strategy;

use Symfony\Component\DomCrawler\Crawler;

class WikiFlagCrawlerStrategy implements ImageCrawlerStrategy
{
    public function crawlImages(string $html): array
    {
        $crawler = new Crawler($html);
        $images = [];

        $crawler->filter('img.thumbborder')->each(function (Crawler $node, $i) use (&$images) {
            $images[] = 'https:'.$node->attr('src');
        });

        return $images;
    }
}
