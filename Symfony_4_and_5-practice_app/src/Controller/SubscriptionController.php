<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Subscription;

class SubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'subscription')]
    public function index(): Response
    {
        return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
        ]);
    }

    /**
     * @Route("/pricing", name="pricing")
     */
    public function pricing()
    {
      return $this->render('front/pricing.html.twig', [
        'name' => Subscription::getPlanDataNames(),
        'price' => Subscription::getPlanDataPrices()
      ]);
    }
}
