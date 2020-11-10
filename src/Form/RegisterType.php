<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Location;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', null, [
            'constraints' => new NotBlank,
            'label' => 'Pseudonyme *',
        ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe doit être identique',
                'first_options' => ['label' => 'Mot de passe *'],
                'second_options' => ['label' => 'Confirmation du mot de passe'],
                'constraints' => [
                    new NotBlank,
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ])
                ],
                ])
            ->add('email', EmailType::class, [
                'label' => 'Email * ',
                'constraints' => [
                    new Email,
                    new NotBlank,
                ],
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Avatar',
                'attr' => [
                    'accept' => '.jpg,.jpeg,.png,.gif'
                ],
                'required' => false,
                'mapped' => false,
            ])
            ->add('presentation',null,  [
                'label' => 'Présentation'
            ])
            ->add('phone',null,  [
                'label' => 'Numéro de téléphone'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => ['novalidate' => 'novalidate'],
        ]);
    }
}
