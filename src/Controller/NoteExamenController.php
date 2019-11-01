<?php

namespace App\Controller;

use App\Entity\NoteExamen;
use App\Form\NoteExamenType;
use App\Repository\NoteExamenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/note/examen")
 */
class NoteExamenController extends AbstractController
{
    /**
     * @Route("/", name="note_examen_index", methods={"GET"})
     */
    public function index(NoteExamenRepository $noteExamenRepository): Response
    {
        return $this->render('note_examen/index.html.twig', [
            'note_examens' => $noteExamenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="note_examen_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $noteExaman = new NoteExamen();
        $form = $this->createForm(NoteExamenType::class, $noteExaman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($noteExaman);
            $entityManager->flush();

            return $this->redirectToRoute('note_examen_index');
        }

        return $this->render('note_examen/new.html.twig', [
            'note_examan' => $noteExaman,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_examen_show", methods={"GET"})
     */
    public function show(NoteExamen $noteExaman): Response
    {
        return $this->render('note_examen/show.html.twig', [
            'note_examan' => $noteExaman,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="note_examen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NoteExamen $noteExaman): Response
    {
        $form = $this->createForm(NoteExamenType::class, $noteExaman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('note_examen_index');
        }

        return $this->render('note_examen/edit.html.twig', [
            'note_examan' => $noteExaman,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="note_examen_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NoteExamen $noteExaman): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noteExaman->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($noteExaman);
            $entityManager->flush();
        }

        return $this->redirectToRoute('note_examen_index');
    }
}
