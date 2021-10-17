<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CreateCategoryFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller\Admin
 * @Route("/admin/categories", name="admin_categories_")
 */
class CategoryController extends AdminController
{
    /**
     * @Route("/create", name="create")
     */
    public function create (Request $request): Response
    {
        $category = new Category();
        $this->denyAccessUnlessGranted('CATEGORY_CREATE', $category);

        $form = $this->createForm(CreateCategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
        }


        return $this->render('admin/category/create.html.twig', [
            'categoryForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit", name="edit")
     */
    public function edit (): Response
    {
        $category = new Category();
        $this->denyAccessUnlessGranted('CATEGORY_EDIT', $category);
        return $this->render('admin/category/edit.html.twig');
    }
}
