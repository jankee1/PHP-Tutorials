<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;

class ToDoListController extends AbstractController
{
    #[Route('/', name: 'to_do_list')]
    public function index(): Response
    {
        $tasks = $this->getDoctrine()
        ->getRepository(Task::class)
        ->findBy([],['id'=>'DESC']); // findALl first

        return $this->render('to_do_list/index.html.twig', [
          'tasks' => $tasks
        ]);
    }

    #[Route('/create', name: 'create_task', methods: ['POST'])]
    public function create(Request $request): Response
    {
      $title = trim($request->request->get('title'));
      if(empty($title))
        return $this->redirectToRoute('to_do_list');

      $em = $this->getDoctrine()->getManager();

      $task = new Task();
      $task->setTitle($title);
      $em->persist($task);
      $em->flush();
      return $this->redirectToRoute('to_do_list');
      // exit($request->request->get('title'));
    }

    #[Route('/switch-status/{id}', name: 'switch_status')]
    public function switchStatus($id)
    {
      $em = $this->getDoctrine()->getManager();
      $task = $em->getRepository(Task::class)->find($id);

      $task->setStatus(! $task->getStatus() );
      $em->flush();

      return $this->redirectToRoute('to_do_list');
    }

    #[Route('/delete/{id}', name: 'delete_task')]
    public function delete($id)
    {
      $em = $this->getDoctrine()->getManager();
      $task = $em->getRepository(Task::class)->find($id);

      $em->remove($task);
      $em->flush();

      return $this->redirectToRoute('to_do_list');
    }
}
