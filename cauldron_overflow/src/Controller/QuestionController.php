<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;

class QuestionController extends AbstractController
{    
    #[Route('/', name:'app_homepage')]
    function homepage(Environment $twigEnviroment): Response
    {
        // $htmnl = $twigEnviroment->render('question/homepage.html.twig');
        // return new Response($htmnl);

        return $this->Render('question/homepage.html.twig');
    }

    #[Route('/question/{slug}', name:'app_question_show')]
    function show($slug): Response
    {

        $answers = [
            'Answer no 1',
            'Answer no 2',
            'Answer no 3',
        ];

        dump($this);

        return $this->render('question/show.html.twig', [
            'question' => sprintf("how to tie shoes %s !", $slug),
            'answers' => $answers,
        ]);

        // return new Response(sprintf(
        //     'how tie shoes "%s" !', $slug
        // ));
    }

}
