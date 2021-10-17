<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use App\Form\CreateMovieFormTYpe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MovieController
 * @package App\Controller\Admin
 * @Route("/admin/movies", name="admin_movies_")
 */
class MovieController extends AdminController
{
    /**
     * @Route("/create", name="create")
     */
    public function create (Request $request): Response
    {
        $movie = new Movie();
        $this->denyAccessUnlessGranted('MOVIE_CREATE', $movie);

        $form = $this->createForm(CreateMovieFormTYpe::class, $movie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movie->setPostedBy($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();
        }

        return $this->render('admin/movie/create.html.twig', [
            'movieForm' => $form->createView()
        ]);
    }
}
