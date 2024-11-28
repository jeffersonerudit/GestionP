<?php

namespace App\Controller;

use App\Entity\TypeViste;
use App\Form\TypeVisteType;
use App\Repository\TypeVisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/type/viste')]
final class TypeVisteController extends AbstractController{
    #[Route(name: 'app_type_viste_index', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function index(TypeVisteRepository $typeVisteRepository): Response
    {
        return $this->render('type_viste/index.html.twig', [
            'type_vistes' => $typeVisteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_viste_new', methods: ['GET', 'POST']), IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeViste = new TypeViste();
        $form = $this->createForm(TypeVisteType::class, $typeViste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeViste);
            $entityManager->flush();
            $this->addFlash('success', 'Le type visiteur a été crée avec succès');
            return $this->redirectToRoute('app_type_viste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_viste/new.html.twig', [
            'type_viste' => $typeViste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_viste_show', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function show(TypeViste $typeViste): Response
    {
        return $this->render('type_viste/show.html.twig', [
            'type_viste' => $typeViste,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_viste_edit', methods: ['GET', 'POST']), IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, TypeViste $typeViste, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeVisteType::class, $typeViste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Le type visiteur a été modifié avec succès');
            return $this->redirectToRoute('app_type_viste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_viste/edit.html.twig', [
            'type_viste' => $typeViste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_viste_delete', methods: ['POST']), IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, TypeViste $typeViste, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeViste->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typeViste);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Le type visiteur a été supprimé avec succès');
        return $this->redirectToRoute('app_type_viste_index', [], Response::HTTP_SEE_OTHER);
    }
}
