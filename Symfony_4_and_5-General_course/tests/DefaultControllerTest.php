<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/home');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello');

        // $this->assertSame(200, $client->getResponse()->getStatusCode());
        // $this->assertContains('Hello', $crawler->filter('h1')->text());
        $this->assertGreaterThan(
          0,
          $crawler->filter("html:contains('Hello')")->count()
        );
        // $this->assertGreaterThan(0, $crawler->filter('h1.class')->count());
        $this->assertCount(1, $crawler->filter("h1"));
        $this->assertTrue(
          $client->getResponse()->headers->contains(
            'Content-Type',
            'application/json'
          ),
          "the 'Content-Type' header is 'application/json'" //optional message shown on failuare
        );
        $this->assertContains('foo', $client->getResponse()->getContent());
    }
}
