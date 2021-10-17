<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Form\CreateImageFormType;
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
    public function create (Request $request):Response
    {
        $image = new Image();
        $this->denyAccessUnlessGranted('IMAGE_CREATE', $image);

        return $this->render('admin/image/create.html.twig');
    }

    public function new (Request $request): Response
    {
        $image = new Image();
        $form = $this->createForm(CreateImageFormType::class, $image);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image->setPostedBy($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
        }

        return $this->renderForm('admin/image/layouts/new.html.twig', [
            'imageForm' => $form
        ]);
    }
}
