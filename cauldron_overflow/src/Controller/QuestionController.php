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

    #[Route('/how/{slug}', name: 'how')]
    public function show($slug): Response
    {
        return new Response(sprintf(
            'how tie shoes "%s" !', $slug
        ));
    }
}
