<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;

class FormController extends AbstractController
{
    #[Route('/form', name: 'form')]
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository(Post::class)->findOneBy([
          'id' => 4
        ]);
        // $post->setTitle("this is an awesome new title");
        // $post->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
        //
        $form = $this->createForm(PostType::class, $post, [
          'action' => $this->generateUrl('form'), // here we set name form router
        ]);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          // $em->persist($post);
        }
        // $em->remove($post);
        // $em->flush();

        return $this->render('form/index.html.twig', [
            'post_form' => $form->createView()
        ]);
    }
}
