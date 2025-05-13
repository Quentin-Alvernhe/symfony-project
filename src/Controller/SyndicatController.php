<?php
namespace App\Controller;

use App\Entity\Syndicat;
use App\Form\SyndicatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/syndicats', name: 'app_syndicat_')]
class SyndicatController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $em): Response
    {
        $syndicats = $em->getRepository(Syndicat::class)->findAll();

        return $this->render('features/gestion/syndicats/syndicatList.html.twig', [
            'items' => $syndicats,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $syndicat = new Syndicat();
        $form = $this->createForm(SyndicatType::class, $syndicat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $syndicat->setCreatedAt(new \DateTimeImmutable());

            foreach ($syndicat->getCotisations() as $cotisation) {
                $cotisation->setSyndicat($syndicat);
                $cotisation->setCreatedAt(new \DateTimeImmutable());
            }

            $em->persist($syndicat);
            $em->flush();

            return $this->redirectToRoute('cotisation_add', ['syndicat' => $syndicat->getId()]);
        }

        return $this->render('features/gestion/syndicats/syndicatForm.html.twig', [
            'form' => $form->createView(),
            'current' => 'syndicat'
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
public function edit(Syndicat $syndicat, Request $request, EntityManagerInterface $em): Response
{
    // Sauvegardez les adresses originales pour comparaison
    $originalAdresses = new \Doctrine\Common\Collections\ArrayCollection();
    foreach ($syndicat->getAdresses() as $adresse) {
        $originalAdresses->add($adresse);
    }
    
    $form = $this->createForm(SyndicatType::class, $syndicat);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
    
        foreach ($syndicat->getCotisations() as $cotisation) {
            $cotisation->setSyndicat($syndicat);
            if (!$cotisation->getCreatedAt()) {
                $cotisation->setCreatedAt(new \DateTimeImmutable());
            }
            $em->persist($cotisation);
        }
        
        foreach ($syndicat->getAdresses() as $adresse) {
            if (!$adresse->getSyndicats()->contains($syndicat)) {
                $adresse->addSyndicat($syndicat);
            }
        }
        
        foreach ($originalAdresses as $originalAdresse) {
            if (!$syndicat->getAdresses()->contains($originalAdresse)) {
                $originalAdresse->removeSyndicat($syndicat);
            }
        }
        
        $syndicat->setUpdatedAt(new \DateTime());
        $em->flush();
        
        $this->addFlash('success', 'Syndicat modifié avec succès.');
        
        return $this->redirectToRoute('app_syndicat_index');
    }
    
    return $this->render('features/gestion/syndicats/syndicatForm.html.twig', [
        'form' => $form->createView(),
        'current' => 'syndicat',
    ]);
}

}
