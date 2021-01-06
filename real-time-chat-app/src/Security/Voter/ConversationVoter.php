<?php

namespace App\Security\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use App\Entity\Conversation;
use App\Repository\ConversationRepository;

class ConversationVoter extends Voter
{
  const VIEW = 'view';

  public function __construct(ConversationRepository $conversationRepository)
  {
    $this->conversationRepository = $conversationRepository;
  }

  protected function supports(string $attribute, $subject)
  {
      return $attribute == self::VIEW && $subject instanceof Conversation;
  }

  protected function voteOnAttribute(string $attribute, $subject, TokenInterface $tokenInterface)
  {
    $result = $this->conversationRepository->checkIfUserIsParticipant(
      $subject->getId(),
      $tokenInterface->getUser()->GetId()
    );

    dd($result);
  }
}
