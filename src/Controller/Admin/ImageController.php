<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ImageController
 * @package App\Controller\Admin
 * @Route("/admin/images", name="admin_images_")
 */
class ImageController extends AdminController
{
    /**
     * @Route("/create", name="create")
     */
    public function create ():Response
    {
        $image = new Image();
        $this->denyAccessUnlessGranted('IMAGE_CREATE', $image);

        return $this->render('admin/image/create.html.twig');
    }
}
