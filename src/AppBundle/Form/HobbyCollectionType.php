<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HobbyCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('hobbyCollection', CollectionType::class, [
            'entry_type' => hobbyType::class,
            'label' => 'Add or remove a hobby:',
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'required' => false,
            'attr' => [
                'class' => 'collection',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\HobbyCollection',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'FancyCollectionType';
    }
}