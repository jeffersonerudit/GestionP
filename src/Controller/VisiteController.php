<?php

namespace App\Controller;

use App\Entity\Viste;
use App\Form\VisiteType;
use App\Repository\StrategieRepository;
use App\Repository\VisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisiteController extends AbstractController
{
    #[Route('/visite', name: 'app_visite')]
    public function index(Request $request, VisteRepository $repository): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 4;
        $visites = $repository->paginateVisites($page);
        return $this->render('visite/index.html.twig', [
            'visites' => $visites
        ]);
    }

    #[Route('/visite/{id}/detail', name: 'visite.detail', methods: ['GET'])]
    public function detail(Viste $visite): Response
    {
        return $this->render('visite/detail.html.twig', [
            'visite' => $visite
        ]);
    }


    #[Route('/visite/{id}/edit', name: 'visite.edit')]
    public function edit(Viste $visite, Request $request, EntityManagerInterface
    $em)
    {
        if (!$visite) {
            $visite = new Viste();
        }
        $form = $this->createForm(VisiteType::class, $visite);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $visite->setDateAt(new \DateTimeImmutable());
            $em->persist($visite);
            $em->flush();
            $this->addFlash('success', 'Le visiteur a été bien Modifiée');
            return $this->redirectToRoute('app_visite');
        }
        return $this->render('visite/edit.html.twig', [
            'visite' => $visite,
            'form' => $form

        ]);
    }

    #[Route('/visite/create', name: 'visite.create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $visite = new Viste();
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $visite->setDate(new \DateTimeImmutable());
            $visite->setDateAt(new \DateTimeImmutable());
            $em->persist($visite);
            $em->flush();
            $this->addFlash('success', 'Le visiteur a été bien créée!');
            return $this->redirectToRoute('app_visite');
        }
        return $this->render('visite/create.html.twig', [

            'form' => $form

        ]);
    }

    #[Route('/visite/{id}', name: 'visite.delete')]
    public function remove(Viste $visite, EntityManagerInterface $em)
    {
        $em->remove($visite);
        $em->flush();
        $this->addFlash('success', 'Le visiteur a été bien supprimée');
        return $this->redirectToRoute('app_visite');
    }
}
