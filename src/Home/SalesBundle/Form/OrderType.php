<?php

namespace Home\SalesBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('number')
            ->add('date', DateTimeType::class, array(
                'widget' => 'single_text',
                'date_format' => 'yyy-MM-dd',
            ))
            ->add('link')
            ->add('phone')
            ->add('delivery')
            ->add('comment')
            ->add('source')
            ->add('status')
            ->add('rows', CollectionType::class, array(
                'entry_type' => OrderRowType::class,
                'allow_add'=>true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\SalesBundle\Entity\Order',
            'allow_extra_fields' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_salesbundle_order';
    }
}
