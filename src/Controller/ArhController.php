<?php

namespace App\Controller;

use App\Entity\Arh;
use App\Form\ArhType;
use App\Repository\ArhRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/arh")
 */
class ArhController extends AbstractController
{
    /**
     * @Route("/", name="app_arh_index", methods={"GET"})
     */
    public function index(ArhRepository $arhRepository): Response
    {
        return $this->render('arh/index.html.twig', [
            'arhs' => $arhRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_arh_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArhRepository $arhRepository): Response
    {
        $arh = new Arh();
        $form = $this->createForm(ArhType::class, $arh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arhRepository->add($arh, true);

            return $this->redirectToRoute('app_arh_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arh/new.html.twig', [
            'arh' => $arh,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arh_show", methods={"GET"})
     */
    public function show(Arh $arh): Response
    {
        return $this->render('arh/show.html.twig', [
            'arh' => $arh,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_arh_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Arh $arh, ArhRepository $arhRepository): Response
    {
        $form = $this->createForm(ArhType::class, $arh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arhRepository->add($arh, true);

            return $this->redirectToRoute('app_arh_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arh/edit.html.twig', [
            'arh' => $arh,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arh_delete", methods={"POST"})
     */
    public function delete(Request $request, Arh $arh, ArhRepository $arhRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arh->getId(), $request->request->get('_token'))) {
            $arhRepository->remove($arh, true);
        }

        return $this->redirectToRoute('app_arh_index', [], Response::HTTP_SEE_OTHER);
    }
}
