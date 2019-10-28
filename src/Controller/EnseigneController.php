<?php

namespace App\Controller;

use App\Entity\Enseigne;
use App\Form\EnseigneType;
use App\Repository\EnseigneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/enseigne")
 */
class EnseigneController extends AbstractController
{
    /**
     * @Route("/", name="enseigne_index", methods={"GET"})
     */
    public function index(EnseigneRepository $enseigneRepository): Response
    {
        return $this->render('enseigne/index.html.twig', [
            'enseignes' => $enseigneRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="enseigne_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $enseigne = new Enseigne();
        $form = $this->createForm(EnseigneType::class, $enseigne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enseigne);
            $entityManager->flush();

            return $this->redirectToRoute('enseigne_index');
        }

        return $this->render('enseigne/new.html.twig', [
            'enseigne' => $enseigne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enseigne_show", methods={"GET"})
     */
    public function show(Enseigne $enseigne): Response
    {
        return $this->render('enseigne/show.html.twig', [
            'enseigne' => $enseigne,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enseigne_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Enseigne $enseigne): Response
    {
        $form = $this->createForm(EnseigneType::class, $enseigne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enseigne_index');
        }

        return $this->render('enseigne/edit.html.twig', [
            'enseigne' => $enseigne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enseigne_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Enseigne $enseigne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseigne->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enseigne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enseigne_index');
    }
}
