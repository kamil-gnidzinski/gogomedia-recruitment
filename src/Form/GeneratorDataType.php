<?php

namespace App\Form;

use App\Entity\Generator;
use App\Entity\GeneratorData;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GeneratorDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('measurementTime', DateTimeType::class,[
                'widget' => 'single_text'
            ])
            ->add('currentPower', IntegerType::class)
            ->add('generatorID', EntityType::class, [
                'class' => Generator::class,
                'choice_label' => 'id',
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GeneratorData::class,
            'csrf_protection' => false
        ]);
    }
}
