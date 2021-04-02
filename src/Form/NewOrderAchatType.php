<?php

namespace App\Form;

use App\Entity\OrdreAchat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewOrderAchatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Automatique')
            ->add('MontantMax')
            ->add('Date')
            ->add('Utilistateur')
            ->add('Lot')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrdreAchat::class,
        ]);
    }
}
