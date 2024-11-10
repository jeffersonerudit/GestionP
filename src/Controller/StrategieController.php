<?php

namespace App\Controller;

use App\Entity\Strategie;
use App\Form\StrategieType;
use App\Repository\StrategieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StrategieController extends AbstractController
{
    #[Route('/strategie', name: 'app_strategie')]

    public function index(Request $request, StrategieRepository $repository): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 4;
        $strategies = $repository->paginateStrategies($page);
        return $this->render('strategie/index.html.twig', [
            'strategies' => $strategies
        ]);
    }

    #[Route('/strategie/{id}/detail', name: 'strategie.detail', methods: ['GET'])]
    public function detail(Strategie $strategie): Response
    {
        return $this->render('strategie/detail.html.twig', [
            'strategie' => $strategie
        ]);
    }

    #[Route('/strategie/create', name: 'strategie.create')]

    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $strategie = new Strategie();
        $form = $this->createForm(StrategieType::class, $strategie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $strategie->setDateAt(new \DateTimeImmutable());
            $strategie->setUpdatedAt(new \DateTimeImmutable());
            $em->persist($strategie);
            $em->flush();
            $this->addFlash('success', 'La strategie a été bien créée!');
            return $this->redirectToRoute('app_strategie');
        }
        return $this->render('strategie/create.html.twig', [

            'form' => $form

        ]);
    }

    #[Route('/strategie/{id}/edit', name: 'strategie.edit')]
    public function edit(Strategie $strategie, Request $request, EntityManagerInterface
    $em)
    {
        if (!$strategie) {
            $strategie = new Strategie();
        }
        $form = $this->createForm(StrategieType::class, $strategie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $strategie->setUpdatedAt(new \DateTimeImmutable());
            $em->persist($strategie);
            $em->flush();
            $this->addFlash('success', 'La personne a été bien Modifiée');
            return $this->redirectToRoute('app_strategie');
        }
        return $this->render('strategie/edit.html.twig', [
            'strategie' => $strategie,
            'form' => $form

        ]);
    }

    #[Route('/strategie/{id}', name: 'strategie.delete')]
    public function remove(Strategie $strategie, EntityManagerInterface $em)
    {
        $em->remove($strategie);
        $em->flush();
        $this->addFlash('success', 'La strategie a été bien supprimée');
        return $this->redirectToRoute('app_strategie');
    }
}
