<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Crawler\Image\Strategy;

use Doctrine\ORM\EntityManager;
use GuessTheFlagBundle\Entity\Flag;
use Symfony\Component\DomCrawler\Crawler;

class WikiFlagCrawlerStrategy implements ImageCrawlerStrategy
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function crawlImages(string $html): array
    {
        $crawler = new Crawler($html);
        $images = [];

        $crawler->filter('a.image img')->each(function (Crawler $node, $i) use (&$images) {
            $image = 'https:'.$node->attr('src');

            $flag = new Flag();
            $flag->setCountry('...');
            $flag->setImage($image);
            $flag->setContinent('');
            $flag->setColors([]);
            $flag->setIsEu(false);
            $flag->setCities([]);

            $this->entityManager->persist($flag);

            $images[] = $image;
        });

        $this->entityManager->flush();

        return $images;
    }
}
