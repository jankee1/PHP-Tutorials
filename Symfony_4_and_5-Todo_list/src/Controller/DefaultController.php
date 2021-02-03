<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default')]
    public function index()
    {
        // return $this->render('default/index.html.twig', [
        //     'controller_name' => 'DefaultController',
        // ]);

        // return new Response("Hello $name");

        // return new RedirectResponse('http://stackoverflow.com');
        // return $this->redirectToRoute('default2');
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();


        return $this->render('default/index.html.twig', [
          'controller_name' => 'DefaultController',
          'users' => $users
        ]);
    }
    #[Route('/default2/', name: 'default2')]
    public function index2()
    {
        return new Response('hello');
    }
}
