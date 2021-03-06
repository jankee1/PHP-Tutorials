<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\SecurityUser;
use App\Entity\Pdf;
use App\Entity\File;
use App\Entity\Author;
use App\Entity\Address;
use App\Services\GiftsService;
use App\Services\ServiceInterface;
use App\Form\VideoFormType;
use App\Form\RegisterUserType;


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
    // #[Route('/home', name: 'home')]
    // public function index(Request $request)
    // {
    //     // $users = $this->getDoctrine()->getRepository(User::class)->findAll();
    //     // exit($request->query->get('page', 'default'));
    //
    //     return $this->render('default/index.html.twig', [
    //       'controller_name' => 'DefaultController',
    //     ]);
    // }
    // public function mostPopularPosts($numer = 3)
    // {
    //   $posts = ['post1', 'post2', 'post3', 'post3'];
    //
    //   return $this->render('default/most_popular_posts.html.twig', [
    //     'posts' => $posts
    //   ]);
    // }
  //   // #[Route('/default2/', name: 'default2')]
  //   // public function index2()
  //   // {
  //   //     return new Response('hello');
  //   // }
  //
  //   #[Route('/blog/{page?}', name: 'blog_lsit', requirements: ['page'=> '\d+'])]
  //   public function blog()
  //   {
  //     return new Response('Optional parameters in url and requirenents for parameters');
  //   }
  //
  //   #[Route(
  //   '/articles/{_locale}/{year}/{slug}/{category}',
  //   defaults: ['category' => 'computers'],
  //   requirements: ['_locale'=> 'en|fr', 'category' => 'computers|tv', 'year' => '\d+'])
  //   ]
  //   public function articles()
  //   {
  //     return new Response('Optional parameters in url and requirenents for parameters');
  //   }
  //
  //   #[Route('/generate-url/{param?}', name: 'generate_url')]
  //   public function generate_url()
  //   {
  //     exit($this->generateUrl(
  //       'generate_url',
  //       ['param' => 10],
  //       UrlGeneratorInterface::ABSOLUTE_URL
  //     ));
  //   }
  //
  //   // #[Route('/download/')]
  //   // public function download()
  //   // {
  //   //   $path = $this->getParameter('download_directory');
  //   //   return $this->file($path, 'file.pdf');
  //   // }
  //
  //   #[Route('/redirect-test/')]
  //   public function redirectTest()
  //   {
  //     return $this->redirectToRoute('route_to_redirect',[ 'param' => 10 ]);
  //   }
  //
  //   #[Route('/url-to-redirect/{param?}', name: 'route_to_redirect')]
  //   public function redirectTo()
  //   {
  //     exit('test redirection');
  //   }
  //
  //   #[Route('/forwarding-to-controller')]
  //   public function forwardingtocontroller()
  //   {
  //       $response = $this->forward(
  //         'App\Controller\DefaultController::methodToForwardTo',
  //         [
  //           'param' => 1
  //         ]
  //       );
  //
  //       return $response;
  //   }
  //
  // #[Route('/url-to-forward-to/{param?}', name: 'route_to_forward_to')]
  // public function methodToForwardTo($param)
  // {
  //   exit('Test controller forwarding - '. $param);
  // }

  // #[Route('/home/{id?}', name: 'home')]
  // public function index(Request $request)
  // {
  //   // ADD
  //     // $em = $this->getDoctrine()->getManager();
  //     //
  //     // $user = new User;
  //     // $user->setName('Robert');
  //     // $em->persist($user);
  //     // $em->flush();
  //     //
  //     // dd($user->getId());
  //   // FIND
  //     // $repository = $this->getDoctrine()->getRepository(User::class);
  //     // $user = $repository->find(1);
  //     // $user = $repository->findOneBy(['name' => 'Robert', 'id' => 5]);
  //     // $user = $repository->findBy(['name' => 'Robert'], ['id' => 'DESC']);
  //     // $user = $repository->findAll();
  //   // UPDATE
  //     // $em = $this->getDoctrine()->getManager();
  //     // $id = 1;
  //     // $user = $em->getRepository(User::class)->find($id);
  //     // if(!$user) {
  //     //   throw $this->createNotFoundException(
  //     //     'No user found under id ' . $id
  //     //   );
  //     // }
  //     // $user->setName('nes user name');
  //     // $em->flush();
  //   // DELETE
  //     // $em = $this->getDoctrine()->getManager();
  //     // $id = 2;
  //     // $user = $em->getRepository(User::class)->find($id);
  //     // $em->remove($user);
  //     // $em->flush();
  //     //
  //     // dd($user);
  //     // $em = $this->getDoctrine()->getManager();
  //     // $conn = $em->getConnection();
  //     // $sql = '
  //     //   SELECT * FROM user u
  //     //   WHERE u.id > :id
  //     // ';
  //     // $stmt = $conn->prepare($sql);
  //     // $stmt->execute(['id' => 1]);
  //     // dd($stmt->fetchAll());
  //     // $em = $this->getDoctrine()->getManager();
  //     // $user = new User;
  //     // $user->setName('Mark');
  //     // $em->persist($user);
  //     // $em->flush();
  //     // $em = $this->getDoctrine()->getManager();
  //     // $user = new User();
  //     // $user->setName('Roberto');
  //     // for($i = 0; $i <= 3; $i++) {
  //     //   $video = new Video();
  //     //   $video->setTitle('Video Title ' . $i);
  //     //   $user->addVideo($video);
  //     //   $em->persist($video);
  //     // }
  //     // $em->persist($user);
  //     // $em->flush();
  //     // dd($video->getId());
  //     // dd($user->getId());
  //     // $video = $this->getDoctrine()
  //     //   ->getRepository(Video::class)
  //     //   ->find(5);
  //     // dd($video->getUser()->getName());
  //     // $user = $this->getDoctrine()
  //     //   ->getRepository(User::class)
  //     //   ->find(9);
  //     // foreach($user->getVideos() as $video)
  //     // {
  //     //   dump($video->getTitle());
  //     // }
  //     // $em = $this->getDoctrine()->getManager();
  //     // $user = new User();
  //     // $user->setName('John');
  //     // $address = new Address();
  //     // $address->setStreet('street1');
  //     // $address->setNumber(12);
  //     // $user->setAdress($address);
  //     // $em->persist($user);
  //     // $em->persist($address);
  //     // $em->flush();
  //     // dump($user->getAdress());
  //     // $em = $this->getDoctrine()->getManager();
  //     // for($i = 1; $i <= 4; $i++)
  //     // {
  //     //   $user = new User();
  //     //   $user->setName('Robert-' . $i);
  //     //   $em->persist($user);
  //     // }
  //     // $em->flush();
  //     // dump($user->getId());
  //     // $user1 = $em->getRepository(User::class)->find(14);
  //     // $user2 = $em->getRepository(User::class)->find(13);
  //     // $user3 = $em->getRepository(User::class)->find(12);
  //     // $user4 = $em->getRepository(User::class)->find(11);
  //     // $user1->addFollowed($user2);
  //     // $user1->addFollowed($user3);
  //     // $user1->addFollowed($user4);
  //     // $em->flush();
  //     $em = $this->getDoctrine()->getManager();
  //     // $user = new User();
  //     // $user->setName("robertikos");
  //     // for($i = 1; $i <= 3; $i++){
  //     //   $video = new Video();
  //     //   $video->setTitle('Video title - ' . $i);
  //     //   $user->addVideo($video);
  //     //   $em->persist($video);
  //     // }
  //     // $em->persist($user);
  //     // $em->flush();
  //     $user = $em->getRepository(User::class)->findWithVideos(16);
  //     dump($user);
  //
  //     return $this->render('default/index.html.twig', [
  //       'controller_name' => 'DefaultController',
  //     ]);
  // }

  // #[Route('/home/{id?}', name: 'home')]
  // public function index(GiftsService $gifts, Request $request, ContainerInterface $container, ServiceInterface $service)
  // {
  //     // $user = [];
  //     // $em = $this->getDoctrine()->getManager();
  //     // $author = $em->getRepository(Author::class)->findByIdWithPdf(1);
  //     // dump($author);
  //     // foreach( $author->getFiles() as $file )
  //     // {
  //     //   // if($file instanceOf Pdf)
  //     //     dump($file->getFilename());
  //     //
  //     // }
  //     // $service->someAction();
  //     // dump($container->get('app.myservice'));
  //
  //     $em = $this->getDoctrine()->getManager();
  //     $user = $em->getRepository(User::class)->find(1);
  //     $user->setName('Rob');
  //     $em->persist($user);
  //     $em->flush();
  //
  //     // $users = $this->getDoctrine()->getRepository(User::class)->findAll();
  //
  //     return $this->render('default/index.html.twig', [
  //       'controller_name' => 'DefaultController',
  //       // 'users' => $users,
  //       'random_gift' => $gifts->gifts
  //     ]);

  // #[Route('/home/{id?}', name: 'home')]
  // public function index(Request $request, \Swift_Mailer $mailer, UserPasswordEncoderInterface $passwordEncoder )
  // {
  //     // $cache = new FileSystemAdapter();
  //     // $posts = $cache->getItem('database.get_posts');
  //     // if(!$posts->isHit()) {
  //     //   $posts_from_db = ['post1', 'post2', 'post3', 'post4' ];
  //     //   dump('Connected with database...');
  //     //   $posts->set(serialize($posts_from_db));
  //     //   $posts->expiresAfter(5);
  //     //   $cache->save($posts);
  //     // }
  //     // $cache->deleteItem('database.get_posts');
  //     // $cache->clear();
  //     // dump(unserialize($posts->get()));
  //     // $cache = new TagAwareAdapter(
  //     //   new FileSystemAdapter()
  //     // );
  //     //
  //     // $acer = $cache->getItem('acer');
  //     // $dell = $cache->getItem('dell');
  //     // $ibm = $cache->getItem('ibm');
  //     // $apple = $cache->getItem('apple');
  //     //
  //     // if(!$acer->isHit()) {
  //     //   $acer_from_db = 'acer laptop';
  //     //   $acer->set($acer_from_db);
  //     //   $acer->tag(['computers', 'laptops', 'acer']);
  //     //   $cache->save($acer);
  //     //   dump('acer from db');
  //     // }
  //     //
  //     // if(!$dell->isHit()) {
  //     //   $dell_from_db = 'dell desktops';
  //     //   $dell->set($dell_from_db);
  //     //   $dell->tag(['computers', 'desktops', 'dell']);
  //     //   $cache->save($dell);
  //     //   dump('dell from db hehe');
  //     // }
  //     //
  //     // $cache->invalidateTags(['acer']);
  //     //
  //     // dump($acer->get());
  //     // dump($dell->get());
  //     // dump($ibm->get());
  //     // dump($apple->get());
  //     // $video->setTitle('write a blog post');
  //     // $video->setCreatedAt(new \DateTime('tomorrow'));
  //
  //     // $em = $this->getDoctrine()->getManager();
  //     // $video = new Video();
  //     // // $videos = $em->getRepository(Video::class)->findAll();
  //     // // dump($videos);
  //     // $form = $this->createForm(VideoFormType::class, $video);
  //     // $form->handleRequest($request);
  //     // if($form->isSubmitted() && $form->isValid())  {
  //     //   // dump($form->getData());
  //     //   $file = $form->get('file')->getData();
  //     //   $fileName = sha1(random_bytes(14) . '.' . $file->guessExtension());
  //     //   $file->move(
  //     //     $this->getParameter('video_directory'),
  //     //     $fileName
  //     //   );
  //     //   $video->setFile($fileName);
  //     //   $em->persist($video);
  //     //   $em->flush();
  //     //   return $this->redirectToRoute('home');
  //     // }
  //     // $message = (new \Swift_Message('HelloEmail'))
  //     //   ->setFrom('send@example.com')
  //     //   ->setTo('recipient@example.com')
  //     //   ->setBody(
  //     //     $this->renderView(
  //     //       'emails/registration.html.twig',
  //     //       ['name' => 'Robertice']
  //     //     ), 'text/html'
  //     //     )
  //     // ;
  //     // $mailer->send($message);
  //     $em = $this->getDoctrine()->getManager();
  //     $users = $em->getRepository(SecurityUser::class)->findAll();
  //     dump($users);
  //
  //     $user = new SecurityUser();
  //     $form = $this->createForm(RegisterUserType::class, $user);
  //     $form->handleRequest($request);
  //
  //     if($form->isSubmitted() && $form->isValid()){
  //       $user->setPassword(
  //         $passwordEncoder->encodePassword($user, $form->get('password')->getData())
  //       );
  //       $user->setEmail($form->get('email')->getData());
  //       $em = $this->getDoctrine()->getManager();
  //       $em->persist($user);
  //       $em->flush();
  //
  //       return $this->redirectToRoute('home');
  //     }
  //
  //     return $this->render('default/index.html.twig', [
  //       'controller_name' => 'DefaultController',
  //       // 'form1' => $form->createView()
  //       'form' => $form->createView()
  //     ]);
  // }

  #[Route('/home', name: 'home')]
  public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder)
  {
      // $em = $this->getDoctrine()->getManager();
      // $video = $em->getRepository(SecurityUser::class)->find(1);
      // dump($users);

      // $user = new SecurityUser();
      // $user->setEmail('admin@admin.com');
      // $password = $passwordEncoder->encodePassword($user, 'passw');
      // $user->setPassword($password);
      // $user->setRoles(['ROLE_ADMIN']);
      //
      // $video = new Video();
      // $video->setTitle('video title');
      // $video->setFile('video path');
      // $video->setCreatedAt(new \DateTime());
      // // $em->persist($video);
      // //
      // // $user->addVideo($video);
      // $em->persist($user);
      // $em->flush();
      //
      // dump($user->getId());
      // dump($video->getId());

      // $this->denyAccessUnlessGranted('VIDEO_DELETE', $video);

      return $this->render('default/index.html.twig', [
        'controller_name' => 'DefaultController',
      ]);
  }


  #[Route('/login', name: 'login')]
  public function login(AuthenticationUtils $authenticationUtils)
  {
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('security/login.html.twig', [
      'last_username' => $lastUsername,
      'error' => $error
    ]);
  }
}
