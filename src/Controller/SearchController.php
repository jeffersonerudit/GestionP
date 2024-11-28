<?php

namespace App\Controller;

use App\Repository\PersonneRepository;
use App\Repository\VisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search', methods:['POST'])]
    public function index(Request $request, VisteRepository $repository): Response
    {
        if ($request->isMethod(method:'POST')){
            $data = $request->request->all();
            $word = $data['word'];

            $result = $repository->search($word);
        }

        return $this->render('search/index.html.twig', [
            'visites' => $result,
            'word'=>$word
        ]);
    }

}
