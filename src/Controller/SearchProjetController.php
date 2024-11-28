<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchProjetController extends AbstractController
{
    #[Route('/search_projet', name: 'app_search_projet', methods: ['POST'])]
    public function SearchProjet(Request $request, ProjetRepository $repository): Response
    {
        if ($request->isMethod(method: 'POST')) {
            $data = $request->request->all();
            $word = $data['word'];
            $result = $repository->searchProjet($word);
        }

        return $this->render('search_projet/index.html.twig', [
            'projets' => $result,
            'word' => $word
        ]);
    }
}
