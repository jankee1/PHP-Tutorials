<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conversations', name: 'conversations.')]

class ConversationController extends AbstractController
{

    public function __construct(UserRepository $userRepository)
    {

    }
    #[Route('/', name: 'getConversations')]
    public function index(Request $request): Response
    {
        $otherUser = $request->get('otherUser', 0);
        return $this->json();
    }
}
