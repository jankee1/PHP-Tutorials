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

  public function buildTree(int $parent_id = null): array
  {
    $subcategory = [];
    foreach($this->categoriesArrayFromDb as $category)
    {
      if($category['parent_id'] == $parent_id)
      {
        $children = $this->buildTree($category['id']);
        if($children) {
          $category['children'] = $children;
        }
        $subcategory[] = $category;
      }
    }
    return $subcategory;
  }

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
