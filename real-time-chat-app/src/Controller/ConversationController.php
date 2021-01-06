<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;
use App\Repository\ConversationRepository;
use App\Entity\Participant;
use App\Entity\Conversation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/conversations', name: 'conversations.')]

class ConversationController extends AbstractController
{

    public function __construct(UserRepository $userRepository,
                                EntityManagerInterface $entityManager,
                                ConversationRepository $conversationRepository)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->conversationRepository = $conversationRepository;

    }
    #[Route('/', name: 'newConversations', methods: ["POST"])]
    public function index(Request $request, int $id): Response
    {
        $otherUser = $request->get('otherUser', 0);
        $otherUser = $this->userRepository->find($id);

        if(is_null($otherUser))
          throw new \Exception('The user was not found');

        //cannot create conversation with myself
        if($otherUser->getId() == $this->getUser()->getId())
          throw new \Exception('You cannot create a conversation with yourself');

        // checks whether conversation already exists
        $conversation = $this->conversationRepository->findConversationByParticipants(
          $otherUser->getId(),
          $this->getUser()->getId()
        );
        // dd($conversation);

        if(count($conversation))
          throw new \Exception('The conversation already exists');

        $conversation = new Conversation();

        $participant = new Participant();
        $participant->setUser($this->getUser());
        $participant->setConversation($conversation);

        $otherParticipant = new Participant();
        $otherParticipant->setUser($otherUser);
        $otherParticipant->setConversation($conversation);

        $this->entityManager->getConnection()->beginTransaction();
        try {
          $this->entityManager->persist($conversation);
          $this->entityManager->persist($participant);
          $this->entityManager->persist($otherParticipant);

          $this->entityManager->flush();
          $this->entityManager->commit();
        } catch (Exception $e) {
          $this->entityManager->rollback();
          throw $e;
        }

        return $this->json([
          'id' => $conversation->getId()
        ], Response::HTTP_CREATED, [], []);
    }

    #[Route('/', name: 'getConversations', methods: ["GET"])]
    public function getConversation()
    {
      $conversations = $this->conversationRepository->findConversationByUser($this->getUser()->getId());

      return $this->json($conversations);
    }

}
