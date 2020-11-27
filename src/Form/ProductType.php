<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null, [
                'label' => 'Nom de la pièce * ',
            ])
            ->add('reference',null, [
                'label' => 'Référence',
            ])
            ->add('picture', FileType::class, [
                'attr' => [
                    'accept' => '.jpg,.jpeg,.png,.gif'
                ],
                'label' => 'Ajoutez une photo de votre objet',
                'required' => false,
                'mapped' => false,
            ])
            ->add('comment',null, [
                'label' => 'Commentaire',
            ])
            ->add('category',null, [
                'label' => 'Catégorie *',
            ])
            ->add('brand',null, [
                'label' => 'Marque *',
            ])
            ->add('city',null, [
                'label' => 'Lieu de retrait * - Saisissez le nom de la ville, Ne saisissez pas un code postal ni votre arrondissement ',
            ])
            ->add('city2',null,[
                'label' => 'Optionnel - Ajoutez un autre lieu de retrait '])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
