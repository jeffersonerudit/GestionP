<?php

namespace App\Controller;

use App\Entity\Enveloppe;
use App\Form\EnveloppeType;
use App\Repository\EnveloppeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/enveloppe')]
final class EnveloppeController extends AbstractController{
    #[Route(name: 'app_enveloppe_index', methods: ['GET'])]
    public function index(EnveloppeRepository $enveloppeRepository): Response
    {
        return $this->render('enveloppe/index.html.twig', [
            'enveloppes' => $enveloppeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_enveloppe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $enveloppe = new Enveloppe();
        $form = $this->createForm(EnveloppeType::class, $enveloppe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($enveloppe);
            $entityManager->flush();

            return $this->redirectToRoute('app_enveloppe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('enveloppe/new.html.twig', [
            'enveloppe' => $enveloppe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enveloppe_show', methods: ['GET'])]
    public function show(Enveloppe $enveloppe): Response
    {
        return $this->render('enveloppe/show.html.twig', [
            'enveloppe' => $enveloppe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_enveloppe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Enveloppe $enveloppe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EnveloppeType::class, $enveloppe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_enveloppe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('enveloppe/edit.html.twig', [
            'enveloppe' => $enveloppe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enveloppe_delete', methods: ['POST'])]
    public function delete(Request $request, Enveloppe $enveloppe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enveloppe->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($enveloppe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_enveloppe_index', [], Response::HTTP_SEE_OTHER);
    }
}
