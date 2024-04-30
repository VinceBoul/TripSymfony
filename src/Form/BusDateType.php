<?php

namespace App\Form;

use App\Entity\Bus;
use App\Entity\BusDate;
use App\Entity\Trajet;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('placeRestantes')
            ->add('trajet', EntityType::class, [
                'class' => Trajet::class,
                'choice_label' => 'id',
            ])
            ->add('bus', EntityType::class, [
                'class' => Bus::class,
                'choice_label' => 'id',
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BusDate::class,
        ]);
    }
}
