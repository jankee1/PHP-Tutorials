<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
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
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     */
    public function create(Request $request) {
        // create a new post with title
        $post = new Post();
        
        $form = $this->createForm(PostType::class, $post);
        

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            //entity manager
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirect($this->generateUrl('post.index'));
        }
        //return a response

        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/show/{id}", name="show")
     * @return Response
     */
    public function show($id, PostRepository $postRepository) {
        $post = $postRepository->find($id);
        // dump($post); die;
        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @return Response
     */
    public function remove($id, PostRepository $postRepository) {
        $post = $postRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash('success', 'Post was removed');

        return $this->redirect($this->generateUrl('post.index'));
    }
}
