<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/home', name: 'home.')]
class HomeController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/helloUser/{name?}', name: 'hello_user')]
    public function helloUser(Request $request, $name)
    {
      $name = $request->get('name');

      $form = $this->createFormBuilder()
                  ->add('fullname')
                  ->getForm()
      ;

      $person = [
        'name' => 'Person1',
        'lastname' => 'Person1Lastname',
        'age' => 23
      ];
      return $this->render('home/greet.html.twig', [
          'controller_name' => 'HelloUser',
          'person' => $person,
          'form' => $form->createView()
      ]);
    }
}
