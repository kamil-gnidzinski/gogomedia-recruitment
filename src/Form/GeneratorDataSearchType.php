<?php

namespace App\Form;

use App\Entity\Generator;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GeneratorDataSearchType extends AbstractType
{
    /** Min number of pages */
    const PAGE_MIN = 1;
    /** Min number of items per page */
    const PERPAGE_MIN = 1;
    /** Default number of pages */
    const PAGE_DEFAULT = 1;
    /** Default number of items per page */
    const PERPAGE_DEFAULT = 100;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateFrom', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('dateTo', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('generator', EntityType::class, [
                'class' => Generator::class,
                'choice_label' => 'id',
            ])
            ->add('page', IntegerType::class, [
                'attr' => [
                    'min' => self::PAGE_MIN,
                    'value' => self::PAGE_DEFAULT
                ]
            ])
            ->add('perpage', IntegerType::class, [
                'attr' => [
                    'min' => self::PERPAGE_MIN,
                    'value' => self::PERPAGE_DEFAULT
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
