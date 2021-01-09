<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Locbucci\JWT\Builder;
use Locbucci\JWT\Signer\Hmac\Sha256;
use Locbucci\JWT\Key;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $username = $this->getUser()->getUsername();
        $token = (new Builder)
          ->withClaim('mercure', ['subscribe' => [sprintf("%s", $username)]])
          ->getToken(
              new Sha256(),
              new Key($this->getParameter('mercure_secret_key'))
            )
          ;
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
