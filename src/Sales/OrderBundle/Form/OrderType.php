<?php

namespace Sales\OrderBundle\Form;

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
                'entry_type' => OrderRowType::class
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sales\OrderBundle\Entity\Order'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sales_orderbundle_order';
    }
}
