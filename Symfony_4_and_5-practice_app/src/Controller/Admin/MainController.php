<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Utils\CategoryTreeAdminOptionList;

use App\Entity\Video;
use App\Entity\User;

// use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admin")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="admin_main_page")
     */
    public function index()
    {
        return $this->render('admin/my_profile.html.twig');
    }

    /**
     * @Route("/videos", name="videos")
     */
    public function videos()
    {

        if ($this->isGranted('ROLE_ADMIN'))
        {
            $videos = $this->getDoctrine()->getRepository(Video::class)->findAll();
        }
        else
        {
            $videos = $this->getUser()->getLikedVideos();
        }

        return $this->render('admin/videos.html.twig',[
            'videos'=>$videos
        ]);
    }



    public function getAllCategories(CategoryTreeAdminOptionList $categories, $editedCategory = null)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $categories->getCategoryList($categories->buildTree());
        return $this->render('admin/_all_categories.html.twig',['categories'=>$categories,'editedCategory'=>$editedCategory]);
    }


}
