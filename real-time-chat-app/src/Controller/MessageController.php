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
    #[Route('/{id}', name: 'getMessages', methods: ["GET"])]
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
        'attributes' => self::ATTRIBUTES_TO_SERIALIZE
      ]);
    }

      #[Route('/{id}', name: 'newMessages', methods: ["POST"])]

      public function newMessage(Request $request, Conversation $conversation)
      {
        $user = $this->getUser();
        $content = $request->get('content', null);

        $message = new Message();
        $message->setContent($content);
        $message->setUser($user);
        $message->setMine(true);

        $conversation->addMessage($message);
        $conversation->setLastMessage($message);

        $this->entityManager->getConnection()->beginTransaction();

        try {
          $this->entityManager->persist($message);
          $this->entityManager->persist($conversation);
          $this->entityManager->flush();
          $this->entityManager->commit();
        } catch(\Exception $e) {
          $this->entityManager->rollback();
          throw $e;
        }
        return $this->json($message, Response::HTTP_CREATED, [], [
          'attributes' => self::ATTRIBUTES_TO_SERIALIZE
        ]);

      }
}
