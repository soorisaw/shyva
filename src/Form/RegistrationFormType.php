<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,['label' => false] )
            ->add('userName', TextType::class,[
                'constraints' => [
                    new Length ([
                        'min' => 2,
                        'minMessage' => 'Votre nom d\'utilisateur doit contenir au moins {{ limit }} caractères.',
                    ]),
                ],
                'label' => false,
            ])
            ->add('userLastName', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom d\'utilisateur doit contenir au moins {{ limit }} caractères.',
                    ]),
                ],
                'label' => false,
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'label' => false,
            ])
            ->add('phone', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'votre numéro doit contenir {{ limit }} chiffres.',
                    ]),
                ],
                'label' => false,
            ])
            ->add('street', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Veuillez saisir une adresse valable',
                    ]),
                ],
                'label' => false,
            ])
            ->add('numTown', IntegerType::class,['label' => false] )
            ->add('town', TextType::class,['label' => false] )
            ->add('avatar', FileType::class, [
                'required' => false,
                'data_class' => null,
                'label' => false
                
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
