<?php

namespace App\Controller\Admin;

use App\Entity\Monster;
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
     * @Route("/create", name="create")
     */
    public function create (): Response
    {
        $monster = new Monster();
        $this->denyAccessUnlessGranted('MONSTER_CREATE', $monster);

        return $this->render('admin/monster/create.html.twig');
    }
}
