<?php

namespace App\Form;

use App\Entity\Generator;
use App\Entity\Report;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reportDate',DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('generatorPower', NumberType::class)
            ->add('generatorID',EntityType::class, [
                'class' => Generator::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Report::class,
            'csrf_protection' => false
        ]);
    }
}
