<?php

namespace App\Utils\AbstractClasses;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class CategoryTreeAbstract {

  protected static $dbconnection;
  public $categoriesArrayFromDb;

  public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $urlgenerator)
  {
    $this->em = $em;
    $this->urlgenerator = $urlgenerator;
    $this->categoriesArrayFromDb = $this->getCategories();
  }

  abstract public function getCategoryList(array $categories_array);

  private function getCategories(): array
  {

    if(self::$dbconnection) {
      return self::$dbconnection;
    }
    else {
      $conn = $this->em->getConnection();
      $sql = 'SELECT * FROM categories';
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      return self::$dbconnection = $stmt->fetchAll();
    }
  }
}
