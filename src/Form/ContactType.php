<?php declare(strict_types=1);
//declare is used to add execution instructions cf doc https://www.php.net/manual/fr/control-structures.declare.php
namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{

    // switch the names of the fields to trap the bot
    public const HONEYPOT_FIELD_NAME = 'email';
    public const EMAIL_FIELD_NAME    = 'information';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'constraints' => new NotBlank,
                'label' => 'Pseudonyme *',
            ])
            ->add(self::HONEYPOT_FIELD_NAME, TextType::class, [
                //I give this label in case of a screen reader can see the field
                'label' =>'Vous ne devez pas remplir ce champ',
                'required' => false
                ])

            ->add(self::EMAIL_FIELD_NAME, EmailType::class, [
                'label' =>'Entrez votre adresse mail *',
                'constraints' => [
                    new Email,
                    new NotBlank,
                ],
            ])
            ->add('subject',TextType::class, [
                'constraints' => [
                    new NotBlank,
                ],
                'label' => 'Sujet du message *',
            ])
            ->add('message',TextareaType::class, [
                'constraints' => [
                    new NotBlank,
                ],
                'label' => 'Message * (25 caractères minimum)',
            ])
 
            ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
