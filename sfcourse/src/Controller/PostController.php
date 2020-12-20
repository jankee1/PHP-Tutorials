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
     */
    public function index(PostRepository $postRepository): Response
    {

        $posts = $postRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) 
    {
        // create new post with a title
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            // entity manager
            $en = $this->getDoctrine()->getManager();
            $file = $request->files->get('post')['attachment'];
            /**
             * @var UploadedFile $file
             */
            if($file) {
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                $file->move(
                    $this->getParameter('uploads_dir'),
                    $filename
                );

                $post->setImage($filename);
                $en->persist($post);
                $en->flush();
            }
            return $this->redirect($this->generateUrl('post.index'));
        }

        // return a response

        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/show/{id}", name="show")
     * @param Post
     * @return Response
     */

    public function show(Post $post) {
        //$id, PostRepository $postRepository  that line was put as a parameters
        // $post = $postRepository->find($id);

        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param $post
     */
    public function remove(Post $post) {
        $en = $this->getDoctrine()->getManager();


        $en->remove($post);
        $en->flush();

        $this->addFlash('success', 'Post was removed');

        return $this->redirect($this->generateUrl('post.index'));
    }
}
