<?php

namespace App\Form;

use App\Entity\Amis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\AmisRepository;

class EditProfilAmisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('telFixe')
            ->add('telPortable')
            ->add('adresse')
            ->add('ville')
            ->add('amis1', EntityType::class, ['class' => Amis::class, 'choice_label' => 'PrenomAndNom'])
            ->add('amis2', EntityType::class, ['class' => Amis::class,'choice_label' => 'PrenomAndNom']);
    }

    //->add('amis2', EntityType::class, ['class' => Amis::class, 'query_builder' => function (AmisRepository $er) { return $er->createQueryBuilder('a') ->where('a.roles NOT LIKE :roles') ->setParameter('roles', '%"' . 'ROLE_A' . '"%');},'choice_label' => 'getPrenomAndNom']);
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Amis::class,
        ]);
    }
}
