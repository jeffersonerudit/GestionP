<?php

namespace App\Controller;

use App\Entity\StatutRendezVous;
use App\Form\StatutRendezVousType;
use App\Repository\StatutRendezVousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/statut/rendezvous')]
final class StatutRendezVousController extends AbstractController{
    #[Route(name: 'app_statut_rendez_vous_index', methods: ['GET'])]
    public function index(StatutRendezVousRepository $statutRendezVousRepository): Response
    {
        return $this->render('statut_rendez_vous/index.html.twig', [
            'statut_rendez_vouses' => $statutRendezVousRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_rendez_vous_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $statutRendezVou = new StatutRendezVous();
        $form = $this->createForm(StatutRendezVousType::class, $statutRendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($statutRendezVou);
            $entityManager->flush();

            return $this->redirectToRoute('app_statut_rendez_vous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statut_rendez_vous/new.html.twig', [
            'statut_rendez_vou' => $statutRendezVou,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_rendez_vous_show', methods: ['GET'])]
    public function show(StatutRendezVous $statutRendezVou): Response
    {
        return $this->render('statut_rendez_vous/show.html.twig', [
            'statut_rendez_vou' => $statutRendezVou,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_rendez_vous_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutRendezVous $statutRendezVou, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StatutRendezVousType::class, $statutRendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_statut_rendez_vous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statut_rendez_vous/edit.html.twig', [
            'statut_rendez_vou' => $statutRendezVou,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_rendez_vous_delete', methods: ['POST'])]
    public function delete(Request $request, StatutRendezVous $statutRendezVou, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutRendezVou->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($statutRendezVou);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_statut_rendez_vous_index', [], Response::HTTP_SEE_OTHER);
    }
}
