<?php

namespace App\Controller;

use App\Entity\Examen;
use App\Form\ExamenType;
use App\Repository\ExamenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/examen")
 */
class ExamenController extends AbstractController
{
    /**
     * @Route("/", name="examen_index", methods={"GET"})
     */
    public function index(ExamenRepository $examenRepository): Response
    {
        return $this->render('examen/index.html.twig', [
            'examens' => $examenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="examen_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $examan = new Examen();
        $form = $this->createForm(ExamenType::class, $examan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($examan);
            $entityManager->flush();

            return $this->redirectToRoute('examen_index');
        }

        return $this->render('examen/new.html.twig', [
            'examan' => $examan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="examen_show", methods={"GET"})
     */
    public function show(Examen $examan): Response
    {
        return $this->render('examen/show.html.twig', [
            'examan' => $examan,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="examen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Examen $examan): Response
    {
        $form = $this->createForm(ExamenType::class, $examan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('examen_index');
        }

        return $this->render('examen/edit.html.twig', [
            'examan' => $examan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="examen_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Examen $examan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$examan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($examan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('examen_index');
    }
}
