<?php

namespace App\Controller;

use App\Entity\StatutP;
use App\Form\StatutPType;
use App\Repository\StatutPRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/statut')]
final class StatutPController extends AbstractController{
    #[Route(name: 'app_statut_p_index', methods: ['GET'])]
    public function index(StatutPRepository $statutPRepository): Response
    {
        return $this->render('statut_p/index.html.twig', [
            'statut_ps' => $statutPRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_p_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $statutP = new StatutP();
        $form = $this->createForm(StatutPType::class, $statutP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($statutP);
            $entityManager->flush();
            $this->addFlash('success', 'le statut du partenaire a été crée avec succès!');
            return $this->redirectToRoute('app_statut_p_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statut_p/new.html.twig', [
            'statut_p' => $statutP,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_p_show', methods: ['GET'])]
    public function show(StatutP $statutP): Response
    {
        return $this->render('statut_p/show.html.twig', [
            'statut_p' => $statutP,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_p_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutP $statutP, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StatutPType::class, $statutP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Le statut du partenaire a été modifié avec succès!');
            return $this->redirectToRoute('app_statut_p_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('statut_p/edit.html.twig', [
            'statut_p' => $statutP,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_p_delete', methods: ['POST'])]
    public function delete(Request $request, StatutP $statutP, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutP->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($statutP);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Le statut du partenaire a été supprimé avec succès!');
        return $this->redirectToRoute('app_statut_p_index', [], Response::HTTP_SEE_OTHER);
    }
}
