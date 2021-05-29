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
        return $this->render('admin/my_profile.html.twig', [
          'subscription' => $this->getUser()->getSubscription()
        ]);
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

    /**
    * @Route("/cancel_plan", name="cancel_plan")
    */
    public function cancelPlan()
    {
      $user = $this->getDoctrine()->getRepository(User::class)->find($this->getUser());

      $subscription = $user->getSubscription();
      $subscription->setValidTo(new \Datetime());
      $subscription->setPaymentStatus(null);
      $subscription->setPlan('canceled');

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($user);
      $entityManager->persist($subscription);
      $entityManager->flush();

      return $this->redirectToRoute('admin_main_page');
    }
}
