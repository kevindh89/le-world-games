<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class CollectFlagsCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName('flaggame:collect-flags');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $url = 'https://en.wikipedia.org/wiki/Gallery_of_sovereign_state_flags';

        $this->getContainer()->get('guesstheflag.crawler.image_crawler')
            ->crawlPage($url);

        $output->writeln('Done collecting flags');
    }
}
