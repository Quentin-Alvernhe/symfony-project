<?php

namespace App\Controller;

use App\Entity\Secteur;
use App\Form\SecteurType;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/entites/secteur', name: 'app_secteur_')]
class SecteurController extends AbstractCrudController
{
    protected string $entityClass = Secteur::class;
    protected string $formClass = SecteurType::class;
    protected string $templatePath = 'features/gestion/entites';
    protected string $routePrefix = 'app_secteur';
    protected string $currentKey = 'secteur';
}
