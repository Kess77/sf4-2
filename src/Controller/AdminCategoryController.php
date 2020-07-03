<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\CategoryFormType;
use App\Form\ConfirmDeletionFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function index(CategoryRepository $repository)
    {
        $category = $repository->findAll();
        return $this->render('admin_category/index.html.twig', [
            'category_list' => $category,
        ]);
    }

    /**
     * @Route("/admin/category/new", name="add_category")
     */
    public function add(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(CategoryFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $entityManager->persist($category);
            $entityManager->flush();


            return $this->redirectToRoute('admin_category');
        }


        return $this->render('admin_category/add.html.twig', [
            'category_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/category/{id}/edit", name="edit_category")
     */
    public function edit(Category $category,Request $request,EntityManagerInterface $entityManager)
    {
        $form=$this->createForm(CategoryFormType::class, $category);
        $form ->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $entityManager->flush();
            $this->addFlash('success','Modification enregistrées');
        }
        return $this->render('admin_category/edit.html.twig',[
            'category'=>$category,
            'category_form'=> $form->createView()

        ]);

    }


    /**
     * @Route("/admin/category/{id}/delete",name="delete_category")
     */
    public function delete(Category $category, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ConfirmDeletionFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->remove($category);
            $entityManager->flush();
            return $this->redirectToRoute('admin_category');

        }
        return $this->render('admin_product/delete.html.twig',[
            'category'=>$category,
            'deletion_form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/",name="show")
     */
    public function show (CategoryRepository $repository){

        for($i=0; $i<=3 ;$i++){
            $categories = $repository->findAll();
        }

            return $this->render('home/index.html.twig',[
                'categories'=>$categories
            ]);





    }
}