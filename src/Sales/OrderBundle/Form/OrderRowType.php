<?php

namespace Sales\OrderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderRowType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('product')
            ->add('purchasePrice')
            ->add('sellingPrice')
            ->add('weightIncluded')
            ->add('weightCost')
            ->add('comment')
            ->add('type')
            ->add('size')
            ->add('shop');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sales\OrderBundle\Entity\OrderRow'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sales_orderbundle_orderrow';
    }
}
