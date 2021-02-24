<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmailsTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->enableProfiler();
        $crawler = $client->request('GET', '/home');

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        $this->assertSame(0, $mailCollector->getMessageCount());
        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        $this->assertInstanceOf('SwiftMessage', $message);
        $this->assertSame('Hello Email', $message->getSubject());
        $this->assertSame('send@example.com', key($message->getForm()));
        $this->assertSame('recipient@example.com', key($message->getTo()));
        $this->assertContains('Hi', $message->getBody());

        // $this->assertContains("Hello World", $crawler->filter('h1')->text());

        // $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
