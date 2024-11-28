<?php

namespace App\Controller;

use App\Repository\RendezVousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchRendezvousController extends AbstractController
{
    #[Route('/search_rendezvous', name: 'app_search_rendezvous', methods: ['POST'])]
    public function SearchRendezvous(Request $request, RendezVousRepository $repository): Response
    {
        if ($request->isMethod(method: 'POST')) {
            $data = $request->request->all();
            $word = $data['word'];
            $result = $repository->searchRendezvous($word);
        }

        return $this->render('search_rendezvous/index.html.twig', [
            'rendrevouss' => $result,
            'word' => $word
        ]);
    }
}