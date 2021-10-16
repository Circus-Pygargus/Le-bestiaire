<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
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
        return $this->render('admin/category/create.html.twig');
    }
}
