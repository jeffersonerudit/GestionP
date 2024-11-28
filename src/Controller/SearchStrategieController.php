<?php

namespace App\Controller;

use App\Repository\StrategieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchStrategieController extends AbstractController
{
    #[Route('/search_strategie', name: 'app_search_strategie', methods: ['POST'])]
    public function SearchStrategie(Request $request, StrategieRepository $repository): Response
    {
        if ($request->isMethod(method: 'POST')) {
            $data = $request->request->all();
            $word = $data['word'];
            $result = $repository->searchStrategie($word);
        }

        return $this->render('search_strategie/index.html.twig', [
            'strategies' => $result,
            'word' => $word
        ]);
    }
}
