<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render(view:'home/index.html.twig');
    }

    #[Route('/template', name: 'template')]
    public function template(): Response
    {
        return $this->render(view: 'template.html.twig');
    }



}

