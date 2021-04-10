<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\CategoryTreeAdminList;
use App\Utils\CategoryTreeAdminOptionList;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_main_page")
     */
    public function index()
    {
        return $this->render('admin/my_profile.html.twig');
    }


    /**
     * @Route("/categories", name="categories", methods={"GET", "POST"})
     */
    public function categories(CategoryTreeAdminList $categories, Request $request)
    {
        $categories->getCategoryList($categories->buildTree());

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $is_invalid = null;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
          // savecategory
          dd('valid');
        } elseif ($request->isMethod('post')) {
          $is_invalid = ' is_invalid';
        }

        return $this->render('admin/categories.html.twig',[
            'categories'=>$categories->categorylist,
            'form' => $form->createView(),
            'is_invalid' => $is_invalid
        ]);
    }

    /**
     * @Route("/edit-category/{id}", name="edit_category")
     */
    public function editCategory(Category $category)
    {
        return $this->render('admin/edit_category.html.twig', [
          'category' => $category
        ]);
    }

    /**
     * @Route("/delete-category/{id}", name="delete_category")
     */
    public function deleteCategory(Category $category)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();
        return $this->redirectToRoute('categories');
    }

    /**
     * @Route("/videos", name="videos")
     */
    public function videos()
    {
        return $this->render('admin/videos.html.twig');
    }

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
        return $this->render('admin/users.html.twig');
    }

    public function getAllCategories(CategoryTreeAdminOptionList $categories, $editedCategory = null)
    {
        $categories->getCategoryList($categories->buildTree());
        return $this->render('admin/_all_categories.html.twig',[
            'categories'=>$categories,
            'editedCategory' => $editedCategory
        ]);
    }
}
