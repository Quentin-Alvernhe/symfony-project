<?php

namespace App\Controller;

use App\Entity\Statut;
use App\Form\StatutType;
use App\Repository\ActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/entites/statut', name: 'app_statut_')]
class StatutController extends AbstractCrudController
{
    protected string $entityClass = Statut::class;
    protected string $formClass = StatutType::class;
    protected string $templatePath = 'features/gestion/entites';
    protected string $routePrefix = 'app_statut';
    protected string $currentKey = 'statut';
}