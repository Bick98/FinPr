<?php

namespace App\Controller;

use App\Entity\FindPlace;
use App\Form\FindPlaceType;
use App\Repository\FindPlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/find/place")
 */
class FindPlaceController extends AbstractController
{
    /**
     * @Route("/", name="app_find_place_index", methods={"GET"})
     */
    public function index(FindPlaceRepository $findPlaceRepository): Response
    {
        return $this->render('find_place/index.html.twig', [
            'find_places' => $findPlaceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_find_place_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FindPlaceRepository $findPlaceRepository): Response
    {
        $findPlace = new FindPlace();
        $form = $this->createForm(FindPlaceType::class, $findPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $findPlaceRepository->add($findPlace, true);

            return $this->redirectToRoute('app_find_place_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('find_place/new.html.twig', [
            'find_place' => $findPlace,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_find_place_show", methods={"GET"})
     */
    public function show(FindPlace $findPlace): Response
    {
        return $this->render('find_place/show.html.twig', [
            'find_place' => $findPlace,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_find_place_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, FindPlace $findPlace, FindPlaceRepository $findPlaceRepository): Response
    {
        $form = $this->createForm(FindPlaceType::class, $findPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $findPlaceRepository->add($findPlace, true);

            return $this->redirectToRoute('app_find_place_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('find_place/edit.html.twig', [
            'find_place' => $findPlace,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_find_place_delete", methods={"POST"})
     */
    public function delete(Request $request, FindPlace $findPlace, FindPlaceRepository $findPlaceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$findPlace->getId(), $request->request->get('_token'))) {
            $findPlaceRepository->remove($findPlace, true);
        }

        return $this->redirectToRoute('app_find_place_index', [], Response::HTTP_SEE_OTHER);
    }
}
