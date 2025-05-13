<?php

namespace App\Form;

use App\Entity\Syndicat;
use App\Entity\Centrale;
use App\Entity\Secteur;
use App\Entity\Activite;
use App\Entity\Statut;
use App\Entity\Specificite;
use App\Entity\Adresse;
use App\Entity\Contact;
use App\Form\CotisationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SyndicatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('acronyme')
            ->add('email')
            ->add('telephone')
            ->add('siret')
            ->add('banque')
            ->add('nomAssoDon', TextType::class, [
            'label' => 'Association de don'])
            ->add('contactPrincipale', EntityType::class, [
                'class' => Contact::class,
                'choice_label' => 'nom',
                'expanded' => false,
                'required' => false,
                'placeholder' => 'Sélectionner un contact',
                'attr' => ['class' => 'js-select2'],
            ])
            ->add('contactSecretariat', EntityType::class, [
                'class' => Contact::class,
                'choice_label' => 'nom',
                'expanded' => false,
                'required' => false,
                'placeholder' => 'Sélectionner un contact',
                'attr' => ['class' => 'js-select2'],
            ])
            ->add('contactComptable', EntityType::class, [
                'class' => Contact::class,
                'choice_label' => 'nom',
                'expanded' => false,
                'required' => false,
                'placeholder' => 'Sélectionner un contact',
                'attr' => ['class' => 'js-select2'],
            ])
            ->add('centrales', EntityType::class, [
                'class' => Centrale::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false, 
                'attr' => ['class' => 'js-select2 allow-select-all'],
            ])
            ->add('secteurs', EntityType::class, [
                'class' => Secteur::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false, 
                'attr' => ['class' => 'js-select2 allow-select-all'],
            ])
            ->add('activites', EntityType::class, [
                'class' => Activite::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false, 
                'attr' => ['class' => 'js-select2 allow-select-all'],
            ])
            ->add('statuts', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false, 
                'attr' => ['class' => 'js-select2 allow-select-all'],
            ])
            ->add('specificites', EntityType::class, [
                'class' => Specificite::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false, 
                'attr' => ['class' => 'js-select2 allow-select-all'],
            ])
            ->add('adresses', EntityType::class, [
                'class' => Adresse::class,
                'choice_label' => function(Adresse $adresse) {
                    return $adresse->getLigne1() . ' - ' . $adresse->getVille();},
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false, 
                'attr' => ['class' => 'js-select2'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Syndicat::class,
        ]);
    }
}
