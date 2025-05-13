<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

abstract class AbstractCrudController extends AbstractController
{
    protected string $entityClass;
    protected string $formClass;
    protected string $templatePath;
    protected string $routePrefix;
    protected string $currentKey;

    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository($this->entityClass);
        $records = method_exists($repository, 'findAllActive')
            ? $repository->findAllActive()
            : $repository->findAll();

        return $this->render("{$this->templatePath}/entiteCrud.html.twig", [
            'items' => $records,
            'current' => $this->currentKey,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $entity = new $this->entityClass();
        $form = $this->createForm($this->formClass, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setCreatedAt(new \DateTimeImmutable());
            $em->persist($entity);
            $em->flush();
            return $this->redirectToRoute("{$this->routePrefix}_index");
        }

        return $this->render("{$this->templatePath}/entiteForm.html.twig", [
            'form' => $form->createView(),
            'current' => $this->currentKey,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit')]
    public function edit(Request $request, $id, EntityManagerInterface $em): Response
    {
        $entity = $em->getRepository($this->entityClass)->find($id);
        if (!$entity) {
            throw $this->createNotFoundException("Objet non trouvé.");
        }
        $form = $this->createForm($this->formClass, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (method_exists($entity, 'setUpdatedAt')) {
                $entity->setUpdatedAt(new \DateTimeImmutable());
            }
            $em->flush();
            return $this->redirectToRoute("{$this->routePrefix}_index");
        }

        return $this->render("{$this->templatePath}/entiteForm.html.twig", [
            'form' => $form->createView(),
            'current' => $this->currentKey,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, $id, EntityManagerInterface $em): Response
    {
        $entity = $em->getRepository($this->entityClass)->find($id);
        if (!$entity) {
            throw $this->createNotFoundException("Objet non trouvé.");
        }
        if ($this->isCsrfTokenValid('delete' . $entity->getId(), $request->request->get('_token'))) {
            $entity->setDeletedAt(new \DateTime());
            $em->flush();
        }
        return $this->redirectToRoute("{$this->routePrefix}_index");
    }
}
