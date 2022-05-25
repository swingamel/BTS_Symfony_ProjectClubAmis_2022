<?php

namespace App\Form;

use App\Entity\Action;
use App\Entity\Inscription;
use App\Repository\AmisRepository;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Amis;

class InscriptionType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('action', EntityType::class, [
                'class' => Action::class,
                'placeholder' => 'Choisir...'
            ])
            ->add('amis', EntityType::class, [
                'class' => Amis::class,
                'choice_label' => 'PrenomAndNom',
                'placeholder' => 'Choisir...'
               ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
