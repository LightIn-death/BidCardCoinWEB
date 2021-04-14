<?php

namespace App\Form;

use App\Entity\Enchere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnchereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Prix')
            ->add('Adjuger')
            ->add('DateHeureVente')
            ->add('Utilistateur')
            ->add('Produit')
            ->add('Lot')
            ->add('Commissaire')
            ->add('OrdreAchat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enchere::class,
        ]);
    }
}
