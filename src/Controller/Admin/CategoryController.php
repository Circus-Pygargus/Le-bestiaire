<?php

namespace App\Controller\Admin;

use App\Entity\Category;
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
    public function create (): Response
    {
        $category = new Category();
        $this->denyAccessUnlessGranted('CATEGORY_CREATE', $category);

        return $this->render('admin/category/create.html.twig');
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
