<?php
namespace App\Controller;

use App\Entity\Cotisation;
use App\Entity\Syndicat;
use App\Form\CotisationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cotisation', name: 'cotisation_')]
class CotisationController extends AbstractController
{
    #[Route('/add/{syndicat}', name: 'add')]
    public function add(Syndicat $syndicat, Request $request, EntityManagerInterface $em): Response
    {
        $cotisation = new Cotisation();
        $cotisation->setSyndicat($syndicat);
        $cotisation->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(CotisationType::class, $cotisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cotisation);
            $em->flush();

            return $this->redirectToRoute('app_syndicat_edit', ['id' => $syndicat->getId()]);
        }

        return $this->render('features/gestion/cotisations/cotisationForm.html.twig', [
            'form' => $form->createView(),
            'syndicat' => $syndicat,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Cotisation $cotisation, EntityManagerInterface $em): Response
    {
        $syndicatId = $cotisation->getSyndicat()?->getId();

        $em->remove($cotisation);
        $em->flush();

        return $this->redirectToRoute('app_syndicat_edit', ['id' => $syndicatId]);
    }
}
