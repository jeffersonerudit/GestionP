<?php

namespace App\Controller;

use App\Entity\RelationP;
use App\Form\RelationPType;
use App\Repository\RelationPRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/relation/p')]
final class RelationPController extends AbstractController{
    #[Route(name: 'app_relation_p_index', methods: ['GET'])]
    public function index(RelationPRepository $relationPRepository): Response
    {
        return $this->render('relation_p/index.html.twig', [
            'relation_ps' => $relationPRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_relation_p_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $relationP = new RelationP();
        $form = $this->createForm(RelationPType::class, $relationP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($relationP);
            $entityManager->flush();
            $this->addFlash('success', 'La realation a été créée avec succès');
            return $this->redirectToRoute('app_relation_p_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('relation_p/new.html.twig', [
            'relation_p' => $relationP,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_relation_p_show', methods: ['GET'])]
    public function show(RelationP $relationP): Response
    {
        return $this->render('relation_p/show.html.twig', [
            'relation_p' => $relationP,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_relation_p_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RelationP $relationP, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RelationPType::class, $relationP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'La relation a été Modifiée avec succès');
            return $this->redirectToRoute('app_relation_p_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('relation_p/edit.html.twig', [
            'relation_p' => $relationP,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_relation_p_delete', methods: ['POST'])]
    public function delete(Request $request, RelationP $relationP, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$relationP->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($relationP);
            $entityManager->flush();
        }
        $this->addFlash('success', 'La relation a été supprimée avec succès');
        return $this->redirectToRoute('app_relation_p_index', [], Response::HTTP_SEE_OTHER);
    }
}
