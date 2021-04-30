<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Video;
use App\Utils\CategoryTreeFrontPage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\UserType;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }

    /**
     * @Route("/video-list/category/{categoryname},{id}/{page}", defaults={"page": "1"}, name="video_list")
     */
    public function videoList($id, $page, CategoryTreeFrontPage $categories, Request $request)
    {
        $ids = $categories->getChildIds($id);
        array_push($ids, $id);

        $videos = $this->getDoctrine()
        ->getRepository(Video::class)
        ->findByChildIds($ids ,$page, $request->get('sortby'));

        $categories->getCategoryListAndParent($id);
        return $this->render('front/video_list.html.twig',[
            'subcategories' => $categories,
            'videos'=>$videos
        ]);
    }

    /**
     * @Route("/video-details", name="video_details")
     */
    public function videoDetails()
    {
        return $this->render('front/video_details.html.twig');
    }

    /**
     * @Route("/search-results/{page}", methods={"GET"}, defaults={"page": "1"}, name="search_results")
     */
    public function searchResults($page, Request $request)
    {
        $videos = null;
        $query = null;

        if($query = $request->get('query'))
        {
            $videos = $this->getDoctrine()
            ->getRepository(Video::class)
            ->findByTitle($query, $page, $request->get('sortby'));

            if(!$videos->getItems()) $videos = null;
        }

        return $this->render('front/search_results.html.twig',[
            'videos' => $videos,
            'query' => $query,
        ]);
    }

    /**
     * @Route("/pricing", name="pricing")
     */
    public function pricing()
    {
        return $this->render('front/pricing.html.twig');
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request)
    {
        $user = new User;
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            dd('registering user ...');
        }
        return $this->render('front/register.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $helper)
    {
        return $this->render('front/login.html.twig', [
            'error' => $helper->getLastAuthenticationError()
            ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() : void
    {
        throw new \Exception('This should never be reached!');
    }

    /**
     * @Route("/payment", name="payment")
     */
    public function payment()
    {
        return $this->render('front/payment.html.twig');
    }

    public function mainCategories()
    {
        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findBy(['parent'=>null], ['name'=>'ASC']);
        return $this->render('front/_main_categories.html.twig',[
            'categories'=>$categories
        ]);
    }
}
