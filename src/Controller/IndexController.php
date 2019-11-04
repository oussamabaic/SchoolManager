<?php

namespace App\Controller;


use App\Repository\ProfRepository;
use App\Repository\EleveRepository;
use App\Repository\ClasseRepository;
use App\Repository\NiveauRepository;
use App\Repository\ParentsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ClasseRepository $classe, ProfRepository $prof, EleveRepository $eleve, ParentsRepository $parents, NiveauRepository $niveau)
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'classe' => $classe->findAll(),
            'prof' => $prof->findAll(),
            'eleve' => $eleve->findAll(),
            'parents' => $parents->findAll(),
            'niveau' => $niveau->findAll(),
        ]);
    }
}