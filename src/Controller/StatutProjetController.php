<?php

namespace App\Controller;

use App\Entity\StatutProjet;
use App\Form\StatutProjetType;
use App\Repository\StatutProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/statutprojet')]
final class StatutProjetController extends AbstractController{
    #[Route(name: 'app_statut_projet_index', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function index(StatutProjetRepository $statutProjetRepository): Response
    {
        return $this->render('statut_projet/index.html.twig', [
            'statut_projets' => $statutProjetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_projet_new', methods: ['GET', 'POST']), IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $statutProjet = new StatutProjet();
        $form = $this->createForm(StatutProjetType::class, $statutProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($statutProjet);
            $entityManager->flush();
            $this->addFlash('success', 'Le statut du projet a été crée avec succès');
            return $this->redirectToRoute('app_statut_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statut_projet/new.html.twig', [
            'statut_projet' => $statutProjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_projet_show', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function show(StatutProjet $statutProjet): Response
    {
        return $this->render('statut_projet/show.html.twig', [
            'statut_projet' => $statutProjet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_projet_edit', methods: ['GET', 'POST']), IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, StatutProjet $statutProjet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StatutProjetType::class, $statutProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Le statut du projet a été modifié avec succès');
            return $this->redirectToRoute('app_statut_projet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statut_projet/edit.html.twig', [
            'statut_projet' => $statutProjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_projet_delete', methods: ['POST']), IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, StatutProjet $statutProjet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutProjet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($statutProjet);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Le statut du projet a été supprimé avec succès');
        return $this->redirectToRoute('app_statut_projet_index', [], Response::HTTP_SEE_OTHER);
    }
}
