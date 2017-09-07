<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image\Strategy;

interface ImageCrawlerStrategy
{
    public function crawlImages(string $html): array;
}
