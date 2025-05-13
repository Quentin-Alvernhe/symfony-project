<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Syndicat;
use App\Entity\Centrale;
use App\Entity\Secteur;
use App\Entity\Activite;
use App\Entity\Statut;
use App\Entity\Specificite;
use App\Entity\Adresse;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('commentaire')
            ->add('adresse', EntityType::class, [
                'class' => Adresse::class,
                'choice_label' => 'ligne_1',
                'required' => false,
            ])
            ->add('emailPro')
            ->add('emailPerso')
            ->add('telephonePortablePro')
            ->add('telephonePortablePerso')
            ->add('siret')
            ->add('nombreSalarie')
            ->add('rpps')
            ->add('dateRetraite')
            ->add('anneeInstallation')
            ->add('syndicat', EntityType::class, [
                'class' => Syndicat::class,
                'choice_label' => 'name',
            ])
            ->add('centrale', EntityType::class, [
                'class' => Centrale::class,
                'choice_label' => 'name',
            ])
            ->add('secteur', EntityType::class, [
                'class' => Secteur::class,
                'choice_label' => 'name',
            ])
            ->add('activite', EntityType::class, [
                'class' => Activite::class,
                'choice_label' => 'name',
            ])
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'name',
            ])
            ->add('specificites', EntityType::class, [
                'class' => Specificite::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
