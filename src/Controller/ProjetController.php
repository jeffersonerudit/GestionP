<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\PersonneType;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'app_projet'), IsGranted('ROLE_ADMIN')]
    public function index(Request $request, ProjetRepository $repository): Response
    {
        $superAdmin = ["ROLE_SUPER_ADMIN", "ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $admin = ["ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $editor = ["ROLE_EDITOR", "ROLE_USER"];
        $user = [];

        if ($this->getUser()) {

        $page = $request->query->getInt('page', 1);
        $limit = 4;
        $projets = $repository->paginateProjets($page);
        return $this->render('projet/index.html.twig', [
            'projets' => $projets
        ]);
        }
        return $this->redirectToRoute('app_login');
    }

    #[Route('/projet/{id}/detail', name: 'projet.detail', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function detail(Projet $projet): Response
    {
        return $this->render('projet/detail.html.twig', [
            'projet' => $projet
        ]);
    }


    #[Route('/projet/{id}/edit', name: 'projet.edit'), IsGranted('ROLE_ADMIN')]
    public function edit(Projet $projet, Request $request, EntityManagerInterface
    $em)
    {
        if (!$projet) {
            $projet = new Projet();
        }
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projet->setCreateAt(new \DateTimeImmutable());
            $em->persist($projet);
            $em->flush();
            $this->addFlash('success', 'Le projet a été bien Modifiée');
            return $this->redirectToRoute('app_projet');
        }
        return $this->render('projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form

        ]);
    }

    #[Route('/projet/create', name: 'projet.create'), IsGranted('ROLE_ADMIN')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projet->setCreateAt(new \DateTimeImmutable());
            $projet->setUpdateAt(new \DateTimeImmutable());
            $em->persist($projet);
            $em->flush();
            $this->addFlash('success', 'Le projet a été bien créée!');
            return $this->redirectToRoute('app_projet');
        }
        return $this->render('projet/create.html.twig', [

            'form' => $form

        ]);
    }

    #[Route('/projet/{id}', name: 'projet.delete'), IsGranted('ROLE_ADMIN')]
    public function remove(Projet $projet, EntityManagerInterface $em)
    {
        $em->remove($projet);
        $em->flush();
        $this->addFlash('success', 'La personne a été bien supprimée');
        return $this->redirectToRoute('app_projet');
    }
}
