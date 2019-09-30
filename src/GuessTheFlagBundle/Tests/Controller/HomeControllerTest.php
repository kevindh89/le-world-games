<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @coversNothing
 */
class HomeControllerTest extends WebTestCase
{
    public function testHomeShowsFourFlags()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertSame($crawler->selectImage('Flag')->count(), 4);
    }
}
