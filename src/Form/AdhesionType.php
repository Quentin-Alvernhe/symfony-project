<?php

namespace App\Form;

use App\Entity\Adhesion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Contact;
use App\Entity\Cotisation;
use App\Entity\Periode;

class AdhesionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contact', EntityType::class, [
                'class' => Contact::class,
                'choice_label' => function (Contact $contact) {
                    return $contact->getPrenom() . ' ' . $contact->getNom();
                },
            ])
            ->add('cotisation', EntityType::class, [
                'class' => Cotisation::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionner une cotisation',
                'required' => true,
            ])
            ->add('periode', EntityType::class, [
                'class' => Periode::class,
                'choice_label' => 'name',
            ])
            ->add('montantDon');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adhesion::class,
        ]);
    }
}
