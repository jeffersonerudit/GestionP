<?php

namespace App\Controller;

use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchPersonneController extends AbstractController
{
    #[Route('/search_personne', name: 'app_search_personne', methods: ['POST'])]
    public function SearchPersonne(Request $request, PersonneRepository $repository): Response
    {
        if ($request->isMethod(method: 'POST')) {
            $data = $request->request->all();
            $word = $data['word'];
            $result = $repository->SearchPersonne($word);
        }

        return $this->render('search_personne/index.html.twig', [
            'personnes' => $result,
            'word' => $word
        ]);

        
    }

    
}