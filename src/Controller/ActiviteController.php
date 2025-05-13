<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Form\ActiviteType;
use App\Repository\ActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/entites/activite', name: 'app_activite_')]
class ActiviteController extends AbstractCrudController
{
    protected string $entityClass = Activite::class;
    protected string $formClass = ActiviteType::class;
    protected string $templatePath = 'features/gestion/entites';
    protected string $routePrefix = 'app_activite';
    protected string $currentKey = 'activite';
}