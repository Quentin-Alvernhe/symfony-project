<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user', name: 'app_user_')]
final class UserController extends AbstractController
{
    #[Route('s', name: 'index')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->createQueryBuilder('u')
            ->andWhere('u.active = true')
            ->getQuery()
            ->getResult();

        return $this->render('features/gestion/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('password')->getData();

            if (!empty($plainPassword)) {
                $hashedPassword = $hasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            }

            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdatedAt(new \DateTime());

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('features/gestion/user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit')]
    public function edit(Request $request, User $user, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('password')->getData();

            if (!empty($plainPassword)) {
                $hashedPassword = $hasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            }

            $user->setUpdatedAt(new \DateTime());
            $em->flush();

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('features/gestion/user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete-user-' . $user->getId(), $request->request->get('_token'))) {
            $user->setActive(false);
            $user->setUpdatedAt(new \DateTime());
            $user->setDeletedAt(new \DateTime());
            $em->flush();
        }

        return $this->redirectToRoute('app_user_index');
    }

    #[Route('/{id}', name: 'show')]
    public function show(User $user): Response
    {
        return $this->render('features/gestion/user/show.html.twig', [
            'user' => $user,
        ]);
    }
}
