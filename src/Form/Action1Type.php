<?php

namespace App\Form;

use App\Entity\Action;
use App\Entity\Amis;
use App\Entity\Commission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class Action1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('dateDebut')
            ->add('duree', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('amis', EntityType::class, ['choice_label' => 'PrenomAndNom', 'class' => Amis::class, 'placeholder' => 'Choisir...'])
            ->add('commission', EntityType::class, ['class' => Commission::class, 'placeholder' => 'Choisir...'], array(
                'data' => '0'))
        ;
    }
//->add('duree', TimeType::class)
//'multiple' => true (Plusieurs choix dans une liste déroulante ? Possible php my admin ?)
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Action::class,
        ]);
    }
}
