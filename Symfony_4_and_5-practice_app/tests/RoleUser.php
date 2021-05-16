<?php

namespace App\Tests;

trait RoleUSer {
  public function setUp(): void
  {
    // parent::setUp();
    // $this->client = static::createClient([], [
    //   'PHP_AUTH_USER' => 'jw@symf4.loc',
    //   'PHP_AUTH_PW' => 'passw'
    // ]);
    // $this->client->disableReboot();
    //
    // $this->em = $this->client->getContainer()->get('doctrine.orm.entity_manager');
    // $this->em->beginTransaction();
    // $this->em->getConnection()->setAutoCommit(false);
    parent::setUp();
    $this->client = static::createClient([], [
        'PHP_AUTH_USER' => 'jd@symf4.loc',
        'PHP_AUTH_PW' => 'passw',
    ]);
    // $this->client->disableReboot();

    $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
    // $this->entityManager->beginTransaction();
    // $this->entityManager->getConnection()->setAutoCommit(false);
  }

  public function tearDown(): void
  {
    parent::tearDown();
    // $this->em->rollback();
    $this->em->close();
    $this->em = null; // avoid memory leaks
  }
}
