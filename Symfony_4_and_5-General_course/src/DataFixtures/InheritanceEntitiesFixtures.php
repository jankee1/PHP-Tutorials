<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\Video;

class InheritanceEntitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 1; $i <= 2; $i++)
        {
          $author = new Author();
          $author->setName('Author_name_' . $i);
          $manager->persist($author);

          for($j = 1; $j <= 2; $j++)
          {
            $pdf = new Pdf();
            $pdf->setFilename('PDF_file_name_' . $j);
            $pdf->setDescription('PDF_description_of_user_' . $j);
            $pdf->setSize(100 + $j);
            $pdf->setOrientation('portrait');
            $pdf->setPagesNumber(200 + $j);
            $pdf->setAuthor($author);
            $manager->persist($pdf);
          }
          for($k = 1; $k <= 2; $k++)
          {
            $video = new Video();
            $video->setFilename('Video_name_of_user_' . $k);
            $video->setDescription('Video_description_of_user_' . $k);
            $video->setSize(300 + $k);
            $video->setFormat('mpeg-2');
            $video->setDuration(500 + $k);
            $video->setAuthor($author);
            $manager->persist($video);
          }
        }

        $manager->flush();
    }
}
