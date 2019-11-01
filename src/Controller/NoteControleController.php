<?php

namespace App\Controller;

use App\Entity\NoteControle;
use App\Form\NoteControleType;
use App\Repository\NoteControleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/note/controle")
 */
class NoteControleController extends AbstractController
{
    /**
     * @Route("/", name="note_controle_index", methods={"GET"})
     */
    public function index(NoteControleRepository $noteControleRepository): Response
    {
        return $this->render('note_controle/index.html.twig', [
            'note_controles' => $noteControleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="note_controle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $noteControle = new NoteControle();
        $form = $this->createForm(NoteControleType::class, $noteControle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($noteControle);
            $entityManager->flush();

            return $this->redirectToRoute('note_controle_index');
        }

        return $this->render('note_controle/new.html.twig', [
            'note_controle' => $noteControle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_controle_show", methods={"GET"})
     */
    public function show(NoteControle $noteControle): Response
    {
        return $this->render('note_controle/show.html.twig', [
            'note_controle' => $noteControle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="note_controle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NoteControle $noteControle): Response
    {
        $form = $this->createForm(NoteControleType::class, $noteControle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('note_controle_index');
        }

        return $this->render('note_controle/edit.html.twig', [
            'note_controle' => $noteControle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_controle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NoteControle $noteControle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noteControle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($noteControle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('note_controle_index');
    }
}
