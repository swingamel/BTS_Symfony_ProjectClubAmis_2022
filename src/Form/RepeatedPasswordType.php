<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RepeatedPasswordType extends AbstractType
{
    public function getParent(): string
    {
        return RepeatedType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe saisis ne correspondent pas.',
            'required' => true,
            'first_options'  => [
                'label' => 'Mot de passe',
                'label_attr' => [
                    'title' => 'Pour des raisons de sécurité, votre mot de passe doit contenir au minimum 6 caractères'
                ],
                'attr' => [
                    'title' => "Pour des raisons de sécurité, votre mot de passe doit contenir au minimum 6 caractères",
                    'maxlength' => 255
                ]
            ],
            'second_options'  => [
                'label' => 'Confirmer le mot de passe',
                'label_attr' => [
                    'title' => 'Confirmer votre mot de passe.'
                ],
                'attr' => [
                    'title' => "Confirmer votre mot de passe.",
                    'maxlength' => 255
                ]
            ]
        ]);
    }
}
