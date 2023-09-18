<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FormationRepository $formationRepository, Request $request): Response
    {
        $categorie = $request->query->get('categorie');

        if ($categorie) {
            $formations = $formationRepository->findByCategorie($categorie);
        } else {
            $formations = $formationRepository->findAll();
        }
    
        $categories = [  
            'Agent de surveillance',
            'SSIAP',
            'Secourisme',
            'Habilitations électriques',
            'Incendie',
        ];
    
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'formations' => $formations,
            'categories' => $categories,  // Ajout de la variable 'categories'
        ]);
    }
    
}