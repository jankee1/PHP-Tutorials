<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        return new Response("Does it work?");
    }

    /**
     * @Route("/questions/{slug}", name="show")
     */

    public function show($slug) {
        return new Response(sprintf(
            'Future pageto show a question "%s"!', 
            ucwords(str_replace('-', ' ', $slug))
        ));
    }
}
