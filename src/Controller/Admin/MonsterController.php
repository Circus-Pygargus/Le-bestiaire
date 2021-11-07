<?php

namespace App\Controller\Admin;

use App\Entity\Monster;
use App\Form\CreateMonsterFormType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MonsterController
 * @package App\Controller\Admin;
 * @Route("/admin/monsters", name="admin_monsters_")
 */
class MonsterController extends AdminController
{
    /**
     * @Route("/create/{categorySlug}", name="create")
     */
    public function create (Request $request, string $categorySlug, CategoryRepository $categoryRepository): Response
    {
        $monster = new Monster();
        $this->denyAccessUnlessGranted('MONSTER_CREATE', $monster);

        $category = $categoryRepository->findOneBy(['slug' => $categorySlug]);
        $monster->setCategory($category);

        $form = $this->createForm(CreateMonsterFormType::class, $monster);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monster);
            $em->flush();
        }

        return $this->renderForm('admin/monster/create.html.twig', [
            'monsterForm' => $form
        ]);
    }
}
