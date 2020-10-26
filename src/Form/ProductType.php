<?php

namespace App\Form;

use App\Entity\City;
use App\Form\CityType;
use App\Entity\Product;
use App\Form\LocationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
            ->add('location', CollectionType::class, [   
                'label' => false, 
                'entry_type' => LocationType::class,
                //I don't want a label so it will be false
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                // this allows the creation of new forms and the prototype too
                'allow_add' => true,
                // self explanatory, this one allows the form to be removed
                'allow_delete' => true
            ])
            	
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
