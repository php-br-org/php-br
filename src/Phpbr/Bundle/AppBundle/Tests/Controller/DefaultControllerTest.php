<?php

namespace Phpbr\Bundle\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contato');

        $this->assertTrue($crawler->filter('html:contains("Contato")')->count() > 0);
    }
}
