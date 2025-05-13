<?php

namespace App\Form;

use App\Entity\Centrale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Syndicat;

class CentraleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la centrale',
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
            'data_class' => Centrale::class,
        ]);
    }
}
