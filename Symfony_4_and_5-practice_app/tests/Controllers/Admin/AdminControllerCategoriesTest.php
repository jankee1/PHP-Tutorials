<?php

namespace App\Tests\Controllers\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Category;

class AdminControllerCategoriesTest extends WebTestCase
{
    public function setUp(): void
    {
      parent::setUp();
      $this->client = static::createClient();
      $this->client->disableReboot();

      $this->em = $this->client->getContainer()->get('doctrine.orm.entity_manager');
      $this->em->beginTransaction();
      $this->em->getConnection()->setAutoCommit(false);
    }

    public function tearDown(): void
    {
      parent::tearDown();
      $this->em->rollback();
      $this->em->close();
      $this->em = null; // avoid memory leaks
    }

    public function testTextOnPage(): void
    {
        $crawler = $this->client->request('GET', '/admin/categories');
        $this->assertSame('Categories list', $crawler->filter('h2')->text());
        $this->assertStringContainsString('Electronics', $this->client->getResponse()->getContent());
    }

    public function testNumberOfItems()
    {
      $crawler = $this->client->request('GET', '/admin/categories');
      $this->assertCount(21, $crawler->filter('option'));
    }

    public function testNewCategory()
    {
      $crawler = $this->client->request('GET', '/admin/categories');

      $form = $crawler->selectButton('Add')->form([
        'category[parent]' => 1,
        'category[name]' => 'Other electronics'
      ]);
      $this->client->submit($form);

      $category = $this->em->getRepository(Category::class)->findOneBy(['name' => 'Other electronics']);

      $this->assertNotNull($category);
      $this->assertSame('Other electronics', $category->getName());
    }

    public function testEditCategory()
    {
        $crawler = $this->client->request('GET', '/admin/edit-category/1');
        $form = $crawler->selectButton('Save')->form([
            'category[parent]' => 0,
            'category[name]' => 'Electronics 2'
        ]);
        $this->client->submit($form);

        $category = $this->em->getRepository(Category::class)->find(1);
        $this->assertSame('Electronics 2', $category->getName());
    }

    public function testDeleteCategory()
    {
      $crawler = $this->client->request('GET', '/admin/delete-category/1');
      $category = $this->em->getRepository(Category::class)->find(1);
      $this->assertNull($category);
    }
}
