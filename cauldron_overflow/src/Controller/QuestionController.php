<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(): Response
    {
        return new Response('some text');
    }

    #[Route('/questions/{slug}', name: 'questions')]
    public function show($slug): Response
    {
        $sql = 

        $answers = [
            'Answer no 1',
            'Answer no 2',
            'Answer no 3',
        ];

        return $this->render('question/show.html.twig', [
            'question' => sprintf("how to tie shoes %s !", $slug),
            'answers' => $answers
        ]);
        // return new Response(sprintf(
        //     'how tie shoes "%s" !', $slug
        // ));
    }
}
