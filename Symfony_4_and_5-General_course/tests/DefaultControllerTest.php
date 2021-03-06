<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
    * @dataProvider provideUrls
    *
    */
    public function testSomething($url)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        // $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('h1', 'Hello');

        // $this->assertSame(200, $client->getResponse()->getStatusCode());
        // $this->assertContains('Hello', $crawler->filter('h1')->text());
        // $this->assertGreaterThan(
        //   0,
        //   $crawler->filter("html:contains('Hello')")->count()
        // );
        // // $this->assertGreaterThan(0, $crawler->filter('h1.class')->count());
        // $this->assertCount(1, $crawler->filter("h1"));
        // $this->assertTrue(
        //   $client->getResponse()->headers->contains(
        //     'Content-Type',
        //     'application/json'
        //   ),
        //   "the 'Content-Type' header is 'application/json'" //optional message shown on failuare
        // );
        // $this->assertContains('foo', $client->getResponse()->getContent());
        // $link = $crawler
        //   ->filter("a:contains('AwesomeLink')")
        //   ->link();
        // $crawler = $client->click($link);
        // $this->assertStringContainsString('Remember me', $client->getResponse()->getContent());
        //
        // $form = $crawler->selectButton('Sign in')->form();
        // $form['email'] = 'e@email.com';
        // $form['password'] = '123';
        // $crawler = $client->submit($form);
        // $crawler = $client->followRedirect();
        // $this->assertEquals(1, $crawler->filter('a:contains("Logout")')->count());

        $this->assertTrue($client->getResponse()->isSuccessful());

    }

    public function provideUrls()
    {
      return [
        ['/home'],
        ['/login']
      ];
    }
}
