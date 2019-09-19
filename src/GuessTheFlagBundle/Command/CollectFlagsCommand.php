<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Command;

use GuessTheFlagBundle\Crawler\Image\ImageCrawler;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CollectFlagsCommand extends ContainerAwareCommand
{
    private $crawler;

    public function __construct(ImageCrawler $crawler)
    {
        $this->crawler = $crawler;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('flaggame:collect-flags');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $url = 'https://en.wikipedia.org/wiki/Gallery_of_sovereign_state_flags';

        $this->crawler->crawlPage($url);

        $output->writeln('Done collecting flags');
    }
}
