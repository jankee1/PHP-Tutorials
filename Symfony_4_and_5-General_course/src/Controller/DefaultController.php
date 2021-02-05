<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Cookie;
use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends AbstractController
{
    public function __construct($logger)
    {

    }

    // public function __construct(GiftsService $giftsservice)
    // {
    //     $giftsservice->gifts = ['a', 'b', 'c', 'd'];
    // }
    #[Route('/', name: 'default')]
    // public function index(GiftsService $giftsservice, Request $request, SessionInterface $session)
    // {
    //     // return $this->render('default/index.html.twig', [
    //     //     'controller_name' => 'DefaultController',
    //     // ]);
    //     // return new Response("Hello $name");
    //     // return new RedirectResponse('http://stackoverflow.com');
    //     // return $this->redirectToRoute('default2');
    //     $users = $this->getDoctrine()->getRepository(User::class)->findAll();
    //     // $gifts = ['flowers', 'car', 'piano', 'money'];
    //     //
    //     // shuffle($gifts);
    //
    //     $this->addflash(
    //       'notice',
    //       'Your changes were saved'
    //     );
    //     $this->addflash(
    //       'warning',
    //       'This is warning'
    //     );
    //
    //     // $cookie = new Cookie(
    //     //   'my_cookie',
    //     //   'cookie value',
    //     //   time() + (2 * 365 * 24 * 60 * 60)
    //     // );
    //     //
    //     // $res = new Response();
    //     // $res->headers->setCookie($cookie);
    //     // $res->send();
    //     // $res = new Response();
    //     // $res->headers->clearCookie('my_cookie');
    //     // $res->send();
    //     // echo $request->cookies->get('PHPSESSID');
    //     $session->set('name', 'session value');
    //     // $session->remove('name');
    //     $session->clear();
    //     if($session->has('name'))
    //       exit($session->get('name'));
    //
    //
    //     return $this->render('default/index.html.twig', [
    //       'controller_name' => 'DefaultController',
    //       'users' => $users,
    //       'random_gift' => $giftsservice->gifts
    //     ]);
    // }
    // public function index(GiftsService $giftsservice, Request $request, SessionInterface $session)
    // {
    //     $users = $this->getDoctrine()->getRepository(User::class)->findAll();
    //     //
    //     // exit($request->query->get('page', 'default'));
    //
    //     return $this->render('default/index.html.twig', [
    //       'controller_name' => 'DefaultController',
    //     ]);
    // }

    #[Route('/', name: 'default')]
    public function index(Request $request)
    {
        // $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        //
        // exit($request->query->get('page', 'default'));

        return $this->render('default/index.html.twig', [
          'controller_name' => 'DefaultController',
        ]);
    }

    // #[Route('/default2/', name: 'default2')]
    // public function index2()
    // {
    //     return new Response('hello');
    // }

    #[Route('/blog/{page?}', name: 'blog_lsit', requirements: ['page'=> '\d+'])]
    public function blog()
    {
      return new Response('Optional parameters in url and requirenents for parameters');
    }

    #[Route(
    '/articles/{_locale}/{year}/{slug}/{category}',
    defaults: ['category' => 'computers'],
    requirements: ['_locale'=> 'en|fr', 'category' => 'computers|tv', 'year' => '\d+'])
    ]
    public function articles()
    {
      return new Response('Optional parameters in url and requirenents for parameters');
    }

    #[Route('/generate-url/{param?}', name: 'generate_url')]
    public function generate_url()
    {
      exit($this->generateUrl(
        'generate_url',
        ['param' => 10],
        UrlGeneratorInterface::ABSOLUTE_URL
      ));
    }

    // #[Route('/download/')]
    // public function download()
    // {
    //   $path = $this->getParameter('download_directory');
    //   return $this->file($path, 'file.pdf');
    // }

    #[Route('/redirect-test/')]
    public function redirectTest()
    {
      return $this->redirectToRoute('route_to_redirect',[ 'param' => 10 ]);
    }

    #[Route('/url-to-redirect/{param?}', name: 'route_to_redirect')]
    public function redirectTo()
    {
      exit('test redirection');
    }

    #[Route('/forwarding-to-controller')]
    public function forwardingtocontroller()
    {
        $response = $this->forward(
          'App\Controller\DefaultController::methodToForwardTo',
          [
            'param' => 1
          ]
        );

        return $response;
    }

  #[Route('/url-to-forward-to/{param?}', name: 'route_to_forward_to')]
  public function methodToForwardTo($param)
  {
    exit('Test controller forwarding - '. $param);
  }

}