<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        // return $this->json([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/MainController.php',
        // ]);
        // return new Response('<h1>Welcome<h1>');
        return $this->render('home/index.html.twig');
    }
    /**
     * @Route("/custom/{name?}", name="custom")
     * @param Request $request
     * @return Response
     */
    public function custom(Request $request) {
        $name = $request->get('name');

        return $this->render('home/custom.html.twig',[
            'name' => $name
        ]);
    }
}