<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints AS Assert;

#[Route('/user')]
final class UserController extends AbstractController{
    #[Route('/admin-user',name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/to/editor' ,name: 'app_user_to_editor')]
    public function ChangeRole(EntityManagerInterface $entityManager, User $user): Response
    {
       $user->setRoles(["ROLE_EDITOR"]);
       $user->setUpdatedAt(new \DateTimeImmutable());
       $entityManager->flush();
        $this->addFlash('success', 'Le Role EDITOR a été affecté avec succès!');
       return $this->redirectToRoute('app_user_index');
    }


    #[Route('/{id}/to/stage', name: 'app_user_to_stage')]
    public function StageRole(EntityManagerInterface $entityManager, User $user): Response
    {
        $user->setRoles(["ROLE_STAGE"]);
        $user->setUpdatedAt(new \DateTimeImmutable());
        $entityManager->flush();
        $this->addFlash('success', 'Le Role STAGE a été affecté avec succès!');
        return $this->redirectToRoute('app_user_index');
    }

    #[Route('/{id}/to/admin', name: 'app_user_to_admin')]
    public function AdminRole(EntityManagerInterface $entityManager, User $user): Response
    {
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setUpdatedAt(new \DateTimeImmutable());
        $entityManager->flush();
        $this->addFlash('success', 'Le Role ADMIN a été affecté avec succès!');
        return $this->redirectToRoute('app_user_index');
    }

    #[Route('/{id}/remove/user/role', name: 'app_user_remove_user_role')]
    public function AdminRoleRemove(EntityManagerInterface $entityManager, User $user): Response
    {
        $user->setRoles([]);
        $user->setUpdatedAt(new \DateTimeImmutable());
        $entityManager->flush();
        $this->addFlash('success', 'Le Role USER a été affecté avec succès!');
        return $this->redirectToRoute('app_user_index');
    }

    #[Route('/profiledit/{id}', name: 'app_user_profiledit', methods: ['GET', 'POST'])]
    public function Profiledit(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher ): Response
    {
        if (!$this->getUser()){
            return $this->redirectToRoute('security.login');
        }

        if ($this->getUser()!== $user){
            return $this->redirectToRoute('app_user_index');
        }
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            
            $user->setUpdatedAt(new \DateTimeImmutable());
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Le profil a été modifier avec succès!');

            return $this->render('user/profil.html.twig', [
                'user' => $user,
            ]);
        
    }
        return $this->render('user/profilupdate.html.twig', [
            
            'form' => $form->createView(),
        ]);
    }




    #[Route('/profil/{id}', name: 'app_user_profil', methods: ['GET', 'POST'])]
    public function Profil(User $user): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_user_index');
        }
        return $this->render('user/profil.html.twig', [
            'user' => $user,
        ]);
       

    }


    

}

