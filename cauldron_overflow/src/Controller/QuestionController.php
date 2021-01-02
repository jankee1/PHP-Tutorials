<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Cache\CacheInterface;
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
    function show($slug, CacheInterface $cache): Response
    {

        $answers = [
            'Answer no 1',
            'Answer no 2',
            'Answer no 3',
        ];

        $questionText = "I've been turned into a cat, any thoughts on how to turn back? While I'm adorable, I don't really care for cat food.";

        


        return $this->render('question/show.html.twig', [
            'question' => sprintf("how to tie shoes %s !", $slug),
            'questionText' => $questionText,
            'answers' => $answers
        ]);

        // return new Response(sprintf(
        //     'how tie shoes "%s" !', $slug
        // ));
    }

}
