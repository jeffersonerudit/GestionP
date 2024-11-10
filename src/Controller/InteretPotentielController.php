<?php

namespace App\Controller;

use App\Entity\InteretPotentiel;
use App\Form\InteretPotentielType;
use App\Repository\InteretPotentielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/interet/potentiel')]
final class InteretPotentielController extends AbstractController{
    #[Route(name: 'app_interet_potentiel_index', methods: ['GET'])]
    public function index(InteretPotentielRepository $interetPotentielRepository): Response
    {
        return $this->render('interet_potentiel/index.html.twig', [
            'interet_potentiels' => $interetPotentielRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_interet_potentiel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $interetPotentiel = new InteretPotentiel();
        $form = $this->createForm(InteretPotentielType::class, $interetPotentiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($interetPotentiel);
            $entityManager->flush();

            return $this->redirectToRoute('app_interet_potentiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('interet_potentiel/new.html.twig', [
            'interet_potentiel' => $interetPotentiel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_interet_potentiel_show', methods: ['GET'])]
    public function show(InteretPotentiel $interetPotentiel): Response
    {
        return $this->render('interet_potentiel/show.html.twig', [
            'interet_potentiel' => $interetPotentiel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_interet_potentiel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InteretPotentiel $interetPotentiel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InteretPotentielType::class, $interetPotentiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_interet_potentiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('interet_potentiel/edit.html.twig', [
            'interet_potentiel' => $interetPotentiel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_interet_potentiel_delete', methods: ['POST'])]
    public function delete(Request $request, InteretPotentiel $interetPotentiel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$interetPotentiel->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($interetPotentiel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_interet_potentiel_index', [], Response::HTTP_SEE_OTHER);
    }
}
