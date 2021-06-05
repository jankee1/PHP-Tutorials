<?php

namespace App\Controller\Admin\Superadmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Utils\Interfaces\UploaderInterface;

use App\Entity\User;
use App\Entity\Video;
use App\Form\VideoType;


/**
 * @Route("/admin/su")
 */
class SuperAdminController extends AbstractController
{

    /**
    * @Route("/upload-video-locally", name="upload_video_locally")
    */
    public function uploadVideoLocally(Request $request, UploaderInterface $fileUploader)
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $file = $video->getUploadedVideo();
            $fileName = $fileUploader->upload($file);

            $base_path = Video::uploadFolder;
            $video->setPath($base_path.$fileName[0]);
            $video->setTitle($fileName[1]);

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

     /**
      * @Route("/delete-video/{video}/{path}", name="delete_video", requirements={"path"=".+"})
      */
     public function deleteVideo(Video $video, $path, UploaderInterface $fileUploader)
     {

         $em = $this->getDoctrine()->getManager();
         $em->remove($video);
         $em->flush();

         if( $fileUploader->delete($path) )
         {
             $this->addFlash(
                 'success',
                 'The video was successfully deleted.'
             );
         }
         else
         {
             $this->addFlash(
                 'danger',
                 'We were not able to delete. Check the video.'
             );
         }

         return $this->redirectToRoute('videos');

     }
}
