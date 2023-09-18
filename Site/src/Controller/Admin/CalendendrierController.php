<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendendrierController extends AbstractController
{
    #[Route('/calendrier', name: 'app_calendrier')]
    public function index(): Response
    {
        return $this->render('calendendrier/index.html.twig', [
            'controller_name' => 'CalendendrierController',
        ]);
    }
}
