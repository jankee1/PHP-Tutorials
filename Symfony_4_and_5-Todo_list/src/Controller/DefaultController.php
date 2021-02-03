<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Services\GiftsService;

class DefaultController extends AbstractController
{

    public function __construct(GiftsService $giftsservice)
    {
        $giftsservice->gifts = ['a', 'b', 'c', 'd'];
    }
    #[Route('/', name: 'default')]
    public function index(GiftsService $giftsservice)
    {
        // return $this->render('default/index.html.twig', [
        //     'controller_name' => 'DefaultController',
        // ]);

        // return new Response("Hello $name");

        // return new RedirectResponse('http://stackoverflow.com');
        // return $this->redirectToRoute('default2');
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        // $gifts = ['flowers', 'car', 'piano', 'money'];
        //
        // shuffle($gifts);

        return $this->render('default/index.html.twig', [
          'controller_name' => 'DefaultController',
          'users' => $users,
          'random_gift' => $giftsservice->gifts
        ]);
    }
    #[Route('/default2/', name: 'default2')]
    public function index2()
    {
        return new Response('hello');
    }
}
