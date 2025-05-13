<?php

namespace App\Controller;

use App\Entity\Centrale;
use App\Form\CentraleType;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/entites/centrale', name: 'app_centrale_')]
class CentraleController extends AbstractCrudController
{
    protected string $entityClass = Centrale::class;
    protected string $formClass = CentraleType::class;
    protected string $templatePath = 'features/gestion/entites';
    protected string $routePrefix = 'app_centrale';
    protected string $currentKey = 'centrale';
}