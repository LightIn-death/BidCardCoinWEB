<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomAuteur')
            ->add('NomStyle')
            ->add('PrixReserve')
            ->add('ReferenceCatalogue')
            ->add('Description')
            ->add('IsSend')
            ->add('Lot')
            ->add('Vendeur')
            ->add('EnchereGagnante')
            ->add('Categorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
