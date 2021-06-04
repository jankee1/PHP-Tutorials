<?php

namespace App\Controller\Admin\Superadmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;


/**
 * @Route("/admin/su")
 */
class SuperAdminController extends AbstractController
{

    /**
     * @Route("/upload-video", name="upload_video")
     */
    public function uploadVideo()
    {
        return $this->render('admin/upload_video.html.twig');
    }

    /**
     * @Route("/users", name="users")
     */
    public function users()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findBy([], [
          'name' => 'ASC'
        ]);

        return $this->render('admin/users.html.twig', [
          'users' => $users
        ]);
    }

    /**
    * @Route("/delete-user/{user}", name="delete_user")
    */
    public function deleteUser(User $user)
    {
      $em = $this->getDoctrine()->getManager();
      $em->remove($user);
      $em->flush();

      return $this->redirectToRoute('users');
    }
}
