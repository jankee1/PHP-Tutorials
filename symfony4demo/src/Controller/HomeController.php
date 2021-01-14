<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;
use App\Services\Fetcher;
use App\Services\Paginator;


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

    #[Route('/newpost', name: 'new_post')]
    public function newpost(Request $request, Fetcher $fetcher)
    {
      // $name = $request->get('name');
      //
      // $form = $this->createFormBuilder()
      //             ->add('fullname')
      //             ->getForm()
      // ;
      //
      // $person = [
      //   'name' => 'Person1',
      //   'lastname' => 'Person1Lastname',
      //   'age' => 23
      // ];

      $post = new Post();

      $form = $this->createForm(PostType::class,$post);

      $form->handleRequest($request);
      // $post->setTitle("this is title: overseas media");
      // $post->setDescription("this is description: overseas media");

      // $em = $this->getDoctrine()->getManager();

      // $retreivedPost = $em->getRepository(Post::class)->findOneBy([
      //   'id' => 1
      // ]);

      // dd($retreivedPost);

      if($form->isSubmitted())
      {
        $file = $request->files->get('post')['my_file'];
        $uploads_directory = $this->getParameter('uploads_directory');
        $filename = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move(
          $uploads_directory,
          $filename
        );

        // dd($file);
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();
      }

      return $this->render('home/greet.html.twig', [
          // 'controller_name' => 'HelloUser',
          // 'person' => $person,
          // 'form' => $form->createView(),
          // 'post' => $retreivedPost
          'post_form' => $form->createView(),
          // 'getURL' => $fetcher->get('https://coinmarketcap.com/v2/listing/')  different url has to be provided in order to the response to be fetched
      ]);
    }

    #[Route('/showPost/{id}', name: 'show_post')]
    public function showPost(Request $request, Post $post)
    {
      return $this->render('home/show_post.html.twig', [
          'post' => $post
      ]);
    }
}
