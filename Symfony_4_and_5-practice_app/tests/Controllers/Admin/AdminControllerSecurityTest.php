<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AdminControllerSecurityTest extends WebTestCase
{
  /**
  * @dataProvider getUrlsForRegularUser
  */
  public function testAccessDeniedForRegularUsers(string $httpMethod, string $url)
  {
    $client = static::createClient([], [
      'PHP_AUTH_USER' => 'jd@symf4.loc',
      'PHP_AUTH_PW' => 'passw'
    ]);
    $client->request($httpMethod, $url);
    $this->assertStringContainsString(Response::HTTP_FORBIDDEN, $client->getResponse()->getStatusCode());
  }

  public function getUrlsForRegularUser()
  {
    yield ['GET', '/admin/su/categories'];
    yield ['GET', '/admin/su/edit-category/1'];
    yield ['GET', '/admin/su/delete-category/1'];
    yield ['GET', '/admin/su/users'];
    yield ['GET', '/admin/su/upload-video'];
  }

  public function testAdminSu()
  {
    $client = static::createClient([], [
      'PHP_AUTH_USER' => 'jw2@symf4.loc',
      'PHP_AUTH_PW' => 'passw'
    ]);
    $crawler = $client->request('GET', '/admin/su/categories');
    $this->assertStringContainsString('Categories list', $crawler->filter('h2')->text());
  }
}
