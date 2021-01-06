<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Conversation;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/messages', name: 'messages.')]

class MessageController extends AbstractController
{
    const ATTRIBUTES_TO_SERIALIZE = ['id', 'content', 'createdAt', 'mine'];

    public function __construct(EntityManagerInterface $entityManager, MessageRepository $messageRepository)
    {
      $this->entityManager = $entityManager;
      $this->messageRepository = $messageRepository;
    }
    #[Route('/{id}', name: 'getMessages')]
    public function index(Request $request, Conversation $conversation): Response
    {
      $this->denyAccessUnlessGranted('view', $conversation);

      $messages = $this->messageRepository->findMessageByConversationId(
        $conversation->getId()
      );

      /**
      *@var $message Message
      */

      array_map(function($message){
        $message->setMine(
          $message->getUser()->getId() === $this->getUser()->getId() ? true : false
        );
      }, $messages);

      return $this->json($messages, Response::HTTP_OK, [], [
        'attributes' =>self::ATTRIBUTES_TO_SERIALIZE
      ]);
    }
}
