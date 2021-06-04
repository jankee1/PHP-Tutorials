<?php

namespace App\Controller\Admin\Superadmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Entity\Video;
use App\Form\VideoType;


/**
 * @Route("/admin/su")
 */
class SuperAdminController extends AbstractController
{

    /**
    * @Route("/upload-video-locally", name="upload_video")
    */
    public function uploadVideoLocally(Request $request)
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $file = $video->getUploadedVideo();
            $fileName = 'to do';

            $base_path = Video::uploadFolder;
            $video->setPath($base_path.$fileName);
            $video->setTitle($fileName);

            $em->persist($video);
            $em->flush();

            return $this->redirectToRoute('videos');
        }


        return $this->render('admin/uploaded_video_locally.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/users", name="users")
     */
    public function users()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findBy([], ['name' => 'ASC']);
        return $this->render('admin/users.html.twig',['users'=>$users]);
    }


    /**
     * @Route("/delete-user/{user}", name="delete_user")
     */
    public function deleteUser(User $user)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('users');
     }
}
