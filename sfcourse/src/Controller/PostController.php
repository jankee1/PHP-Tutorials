<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/post", name="post.")
*/

class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     */
    public function create(Request $request) {
        // create a new post with title
        $post = new Post();
        
        $post->setTitle('This is going to be a title');
        
        //entity manager
        $em = $this->getDoctrine()->getManager();

        $em->persist($post);
        
        $em->flush();
        //return a response

        return new Response('Post was created');
    }
}
