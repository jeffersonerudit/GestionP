<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Repository\PersonneRepository;
use App\Repository\RendezVousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RendezVousController extends AbstractController
{
    #[Route('/rendez_vous', name: 'app_rendezvous'), IsGranted('ROLE_STAGE')]
    public function index(Request $request, RendezVousRepository $repository): Response
    {
        $superAdmin = ["ROLE_SUPER_ADMIN", "ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $admin = ["ROLE_ADMIN", "ROLE_EDITOR", "ROLE_USER"];
        $editor = ["ROLE_EDITOR", "ROLE_USER"];
        $user = [];

        if ($this->getUser()) {

        $page = $request->query->getInt('page', 1);
        $limit = 4;
        $rendezvouss = $repository->paginateRendezvouss($page);
        return $this->render('rendez_vous/index.html.twig', [
            'rendezvouss' => $rendezvouss
        ]);
        }
        return $this->redirectToRoute('app_login');
    }

    #[Route('/rendez_vous/{id}/detail', name: 'rendezvous.detail', methods: ['GET']), IsGranted('ROLE_ADMIN')]
    public function detail(RendezVous $rendezvous): Response
    {
        return $this->render('rendez_vous/detail.html.twig', [
            'rendezvous' => $rendezvous
        ]);
    }


    #[Route('/rendez_vous/{id}/edit', name: 'rendezvous.edit'), IsGranted('ROLE_ADMIN')]
    public function edit(RendezVous $rendezvous, Request $request, EntityManagerInterface
    $em)
    {
        if (!$rendezvous) {
            $rendezvous = new RendezVous();
        }
        $form = $this->createForm(RendezVousType::class, $rendezvous);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvous->setdateAt(new \DateTimeImmutable());
            $em->persist($rendezvous);
            $em->flush();
            $this->addFlash('success', 'Le Rendez-vous a été bien Modifié');
            return $this->redirectToRoute('app_rendezvous');
        }
        return $this->render('rendez_vous/edit.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form

        ]);
    }

    #[Route('/rendez_vous/create', name: 'rendezvous.create'), IsGranted('ROLE_ADMIN')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $rendezvous = new RendezVous();
        $form = $this->createForm(RendezVousType::class, $rendezvous);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvous->setDateAt(new \DateTimeImmutable());
            $rendezvous->setCreatedAt(new \DateTimeImmutable());
            $em->persist($rendezvous);
            $em->flush();
            $this->addFlash('success', 'Le Rendez-vous a été bien créé!');
            return $this->redirectToRoute('app_rendezvous');
        }
        return $this->render('rendez_vous/create.html.twig', [

            'form' => $form

        ]);
    }

    #[Route('/rendez_vous/{id}', name: 'rendezvous.delete'), IsGranted('ROLE_ADMIN')]
    public function remove(RendezVous $rendezvous, EntityManagerInterface $em)
    {
        $em->remove($rendezvous);
        $em->flush();
        $this->addFlash('success', 'Le rendezvous a été bien supprimé');
        return $this->redirectToRoute('app_rendezvous');
    }
}
