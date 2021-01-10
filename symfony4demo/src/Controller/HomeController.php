<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;


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

      $post = new Post();
      $post->setTitle("this is title: overseas media");
      $post->setDescription("this is description: overseas media");

      $em = $this->getDoctrine()->getManager();

      $retreivedPost = $em->getRepository(Post::class)->findOneBy([
        'id' => 1
      ]);

      // $em->persist($post);
      // $em->flush();

      // dd($retreivedPost);

      return $this->render('home/greet.html.twig', [
          'controller_name' => 'HelloUser',
          'person' => $person,
          'form' => $form->createView(),
          'post' => $retreivedPost
      ]);
    }
}
