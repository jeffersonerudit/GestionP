<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\ArgumentResolver\EntityValueResolver;
use Symfony\Component\TypeInfo\Type;

class PersonneController extends AbstractController
{
    #[Route('/personne', name: 'app_personne')]
    public function index(Request $request, PersonneRepository $repository): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 4;
        $personnes = $repository->paginatePersonnes($page);
        return $this->render('personne/index.html.twig', [
            'personnes'=> $personnes
        ]);
    }
    
    #[Route('/personne/{id}/detail', name: 'personne.detail', methods: ['GET'])]
    public function detail(Personne $personne): Response
    {
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne
        ]);
    }
     

    #[Route('/personne/{id}/edit', name: 'personne.edit')]
    public function edit(Personne $personne, Request $request, EntityManagerInterface
     $em)
    {
        if(!$personne){
            $personne = new Personne();
        }
        $form = $this->createForm(PersonneType::class, $personne);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $personne->setUpdatedAt(new \DateTimeImmutable());
            $em->persist($personne);
            $em->flush();
            $this->addFlash('success', 'La personne a été bien Modifiée');
            return $this->redirectToRoute('app_personne');
        }
         return $this->render('personne/edit.html.twig', [
            'personne' => $personne,
            'form' => $form
    
        ]);
    }

    #[Route('/personne/create', name: 'personne.create')]
    public function create( Request $request, EntityManagerInterface $em): Response
    {
        $personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $personne->setDateAt(new \DateTimeImmutable());
            $personne->setUpdatedAt(new \DateTimeImmutable());
            $em->persist($personne);
            $em->flush();
            $this->addFlash('success','La personne a été bien créée!');
            return $this->redirectToRoute('app_personne');

        }
        return $this->render('personne/create.html.twig', [

            'form' => $form

        ]);
    }

    #[Route('/personne/{id}', name: 'personne.delete')]
    public function remove(Personne $personne, EntityManagerInterface $em)
    {
        $em->remove($personne);
        $em->flush();
        $this->addFlash('success', 'La personne a été bien supprimée');
        return $this->redirectToRoute('app_personne');
    }
    
}
