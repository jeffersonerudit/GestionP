<?php

namespace App\Controller;

use App\Entity\NatureVisite;
use App\Form\NatureVisiteType;
use App\Repository\NatureVisiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/nature/visite')]
final class NatureVisiteController extends AbstractController{
    #[Route(name: 'app_nature_visite_index', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function index(NatureVisiteRepository $natureVisiteRepository): Response
    {
        return $this->render('nature_visite/index.html.twig', [
            'nature_visites' => $natureVisiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nature_visite_new', methods: ['GET', 'POST']), IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $natureVisite = new NatureVisite();
        $form = $this->createForm(NatureVisiteType::class, $natureVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($natureVisite);
            $entityManager->flush();
            $this->addFlash('success', 'La nature du visiteur a été crée avec succès');
            return $this->redirectToRoute('app_nature_visite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nature_visite/new.html.twig', [
            'nature_visite' => $natureVisite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nature_visite_show', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function show(NatureVisite $natureVisite): Response
    {
        return $this->render('nature_visite/show.html.twig', [
            'nature_visite' => $natureVisite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nature_visite_edit', methods: ['GET', 'POST']), IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, NatureVisite $natureVisite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NatureVisiteType::class, $natureVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'La nature du visiteur a été modifiée avec succès');
            return $this->redirectToRoute('app_nature_visite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nature_visite/edit.html.twig', [
            'nature_visite' => $natureVisite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nature_visite_delete', methods: ['POST']), IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, NatureVisite $natureVisite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$natureVisite->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($natureVisite);
            $entityManager->flush();
        }
        $this->addFlash('success', 'La nature du visiteur a été supprimée avec succès');
        return $this->redirectToRoute('app_nature_visite_index', [], Response::HTTP_SEE_OTHER);
    }
}
