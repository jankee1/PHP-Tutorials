<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Utils\CategoryTreeFrontPage;
use App\Entity\Video;

class FrontController extends AbstractController
{
    #[Route('/', name: 'main_page')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig');
    }

    #[Route('/video-list/category/{categoryname},{id}/{page}', name: 'video_list', defaults: ['page' => 1, 'name' => 'video_list'])]
    public function videoList($id, CategoryTreeFrontPage $categories, $page, Request $request): Response
    {
        $categories->getCategoryListAndParent($id);
        $ids = $categories->getChildIds($id);
        array_push($ids, $id);
        $videos = $this->getDoctrine()
          ->getRepository(Video::class)
          ->findByChildIds($ids, $page, $request->get('sortby'));

        return $this->render('front/video_list.html.twig', [
          'subcategories' => $categories,
          'videos' => $videos
        ]);
    }

    #[Route('/video-details', name: 'video_details')]
    public function videoDetails(): Response
    {
        return $this->render('front/video_details.html.twig');
    }

    #[Route('/search-result', name: 'search_results', methods: ['POST'])]
    public function searchResults(): Response
    {
        return $this->render('front/search_results.html.twig');
    }

    #[Route('/pricing', name: 'pricing')]
    public function pricing(): Response
    {
        return $this->render('front/pricing.html.twig');
    }

    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('front/register.html.twig');
    }

    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('front/login.html.twig');
    }

    #[Route('/payment', name: 'payment')]
    public function payment(): Response
    {
        return $this->render('front/payment.html.twig');
    }

    public function mainCategories()
    {
      $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findBy(['parent' => null], ['name' => 'ASC']);
      return $this->render('front/_main_categories.html.twig', [
        'categories' => $categories
      ]);
    }
}
