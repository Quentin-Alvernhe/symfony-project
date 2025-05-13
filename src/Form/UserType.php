<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'choice_label' => 'name',
                'label' => 'Rôle',
                'query_builder' => function (\App\Repository\RoleRepository $repo) {
                    return $repo->createQueryBuilder('r')
                        ->where('r.name IN (:allowed)')
                        ->setParameter('allowed', ['gomed', 'syndicat']);
                }
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'required' => false,
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmez le mot de passe'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
