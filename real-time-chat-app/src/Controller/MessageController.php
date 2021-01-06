<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Conversation;

#[Route('/messages', name: 'messages.')]

class MessageController extends AbstractController
{
    #[Route('/{id}', name: 'getMessages')]
    public function index(Request $request, Conversation $conversation): Response
    {
      $this->denyAccessUnlessGranted('view', $conversation);
      return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
      ]);
    }
}
