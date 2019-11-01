<?php

namespace App\Controller;

use App\Entity\Controle;
use App\Form\ControleType;
use App\Repository\ControleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/controle")
 */
class ControleController extends AbstractController
{
    /**
     * @Route("/", name="controle_index", methods={"GET"})
     */
    public function index(ControleRepository $controleRepository): Response
    {
        return $this->render('controle/index.html.twig', [
            'controles' => $controleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="controle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $controle = new Controle();
        $form = $this->createForm(ControleType::class, $controle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($controle);
            $entityManager->flush();

            return $this->redirectToRoute('controle_index');
        }

        return $this->render('controle/new.html.twig', [
            'controle' => $controle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="controle_show", methods={"GET"})
     */
    public function show(Controle $controle): Response
    {
        return $this->render('controle/show.html.twig', [
            'controle' => $controle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="controle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Controle $controle): Response
    {
        $form = $this->createForm(ControleType::class, $controle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('controle_index');
        }

        return $this->render('controle/edit.html.twig', [
            'controle' => $controle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="controle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Controle $controle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$controle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($controle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('controle_index');
    }
}
