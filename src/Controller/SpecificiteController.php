<?php

namespace App\Controller;

use App\Entity\Specificite;
use App\Form\SpecificiteType;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/entites/specificite', name: 'app_specificite_')]
class SpecificiteController extends AbstractCrudController
{
    protected string $entityClass = Specificite::class;
    protected string $formClass = SpecificiteType::class;
    protected string $templatePath = 'features/gestion/entites';
    protected string $routePrefix = 'app_specificite';
    protected string $currentKey = 'specificite';
}