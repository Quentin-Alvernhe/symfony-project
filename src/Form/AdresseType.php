<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Syndicat;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ligne_1', TextType::class, [
                'label' => 'Ligne 1',
            ])
            ->add('ligne_2', TextType::class, [
                'label' => 'Ligne 2',
                'required' => false,
            ])
            ->add('ligne_3', TextType::class, [
                'label' => 'Ligne 3',
                'required' => false,
            ])
            ->add('code_postal', TextType::class, [
                'label' => 'Code postal',
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('region', TextType::class, [
                'label' => 'Région',
                'required' => false,
            ])
            ->add('departement', TextType::class, [
                'label' => 'Département',
                'required' => false,
            ])
            ->add('code_pays', TextType::class, [
                'label' => 'Code pays',
                'required' => false,
            ])
            ->add('pays', TextType::class, [
                'label' => 'Pays',
            ])
            ->add('syndicats', EntityType::class, [
                'class' => Syndicat::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
                'label' => 'Syndicats associés',
                'required' => false,
                'attr' => ['class' => 'js-select2 allow-select-all'],
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
