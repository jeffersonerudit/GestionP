<?php

namespace App\Controller;

use App\Entity\Realisation;
use App\Form\RealisationType;
use App\Repository\RealisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RealisationController extends AbstractController
{
    #[Route('/realisation', name: 'app_realisation'), IsGranted('ROLE_STAGE')]
    public function index(Request $request, RealisationRepository $repository): Response
    {
        $superAdmin = ["ROLE_SUPER_ADMIN", "ROLE_ADMIN", "ROLE_STAGE", "ROLE_EDITOR", "ROLE_USER"];
        $admin = ["ROLE_ADMIN", "STAGE", "ROLE_EDITOR", "ROLE_USER"];
        $stage = ["STAGE", "ROLE_EDITOR", "ROLE_USER"];
        $editor = ["ROLE_EDITOR", "ROLE_USER"];
        $user = [];

        //if ($this->getUser()) {
        $page = $request->query->getInt('page', 1);
        $limit = 4;
        $realisations = $repository->paginateRealisations($page);
        return $this->render('realisation/index.html.twig', [
            'realisations' => $realisations
        ]);
       // }
        return $this->redirectToRoute('app_login');
    }

    #[Route('/realisation/{id}/detail', name: 'realisation.detail', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function detail(Realisation $realisation): Response
    {
        return $this->render('realisation/detail.html.twig', [
            'realisation' => $realisation
        ]);
    }


    #[Route('/realisation/{id}/edit', name: 'realisation.edit'), IsGranted('ROLE_ADMIN')]
    public function edit(Realisation $realisation, Request $request, EntityManagerInterface
    $em)
    {
        if (!$realisation) {
            $personne = new Realisation();
        }
        $form = $this->createForm(RealisationType::class, $realisation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $realisation->setDateAt(new \DateTimeImmutable());
            $em->persist($realisation);
            $em->flush();
            $this->addFlash('success', 'La realisation a été bien Modifiée');
            return $this->redirectToRoute('app_realisation');
        }
        return $this->render('realisation/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form

        ]);
    }

    #[Route('/realisation/create', name: 'realisation.create'), IsGranted('ROLE_ADMIN')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $realisation = new Realisation();
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $realisation->setDateR(new \DateTimeImmutable());
            $realisation->setDateAt(new \DateTimeImmutable());
            $em->persist($realisation);
            $em->flush();
            $this->addFlash('success', 'La réalisation a été bien créée!');
            return $this->redirectToRoute('app_realisation');
        }
        return $this->render('realisation/create.html.twig', [

            'form' => $form

        ]);
    }

    #[Route('/realisation/{id}', name: 'realisation.delete'), IsGranted('ROLE_ADMIN')]
    public function remove(Realisation $realisation, EntityManagerInterface $em)
    {
        $em->remove($realisation);
        $em->flush();
        $this->addFlash('success', 'La realisation a été bien supprimée');
        return $this->redirectToRoute('app_realisation');
    }
}
