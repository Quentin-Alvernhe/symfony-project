<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/entites/adresse', name: 'app_adresse_')]
class AdresseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(AdresseRepository $adresseRepository): Response
    {
        $adresses = $adresseRepository->findAllActive();

        return $this->render('features/gestion/entites/entiteCrud.html.twig', [
            'adresses' => $adresses,
            'current' => 'adresse',
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $adresse->setCreatedAt(new \DateTimeImmutable());
            $em->persist($adresse);
            $em->flush();

            return $this->redirectToRoute('app_adresse_index');
        }

        return $this->render('features/gestion/entites/entiteForm.html.twig', [
            'form' => $form->createView(),
            'current' => 'adresse',
        ]);
    }

    #[Route('/{id}/edit', name: 'edit')]
    public function edit(Request $request, Adresse $adresse, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(AdresseType::class, $adresse);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_adresse_index');
        }

        return $this->render('features/gestion/entites/entiteForm.html.twig', [
            'form' => $form->createView(),
            'current' => 'adresse',
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Adresse $adresse, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->request->get('_token'))) {
            $adresse->setDeletedAt(new \DateTime());
            $em->flush();
        }

        return $this->redirectToRoute('app_adresse_index');
    }
}
