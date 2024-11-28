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
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/interet/potentiel')]
final class InteretPotentielController extends AbstractController{
    #[Route(name: 'app_interet_potentiel_index', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function index(InteretPotentielRepository $interetPotentielRepository): Response
    {
        $superAdmin = ["ROLE_SUPER_ADMIN", "ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $admin = ["ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $editor = ["ROLE_EDITOR", "ROLE_USER"];
        $user = [];

        //if ($this->getUser()) {

        return $this->render('interet_potentiel/index.html.twig', [
            'interet_potentiels' => $interetPotentielRepository->findAll(),
        ]);
        
        //}
        //return $this->redirectToRoute('app_login');
    }

    #[Route('/new', name: 'app_interet_potentiel_new', methods: ['GET', 'POST']), IsGranted('ROLE_ADMIN')]
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

    #[Route('/{id}', name: 'app_interet_potentiel_show', methods: ['GET']), IsGranted('ROLE_ADMIN')]
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

    #[Route('/editor///{id}', name: 'app_interet_potentiel_delete', methods: ['POST'])]
    public function delete(Request $request, InteretPotentiel $interetPotentiel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$interetPotentiel->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($interetPotentiel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_interet_potentiel_index', [], Response::HTTP_SEE_OTHER);
    }
}
