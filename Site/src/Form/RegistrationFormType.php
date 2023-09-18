<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
        ->add('email', EmailType::class, [
            'attr' => [
                'placeholder' => 'Votre Email',
                'class' => 'form-control border-0 p-4',
                
                'required' => true,
                'autofocus' => true,
            ],
        ])
    
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'label' => "J'accepte les termes d'utilisation",  // Updated label text
            'label_attr' => ['class' => 'form-check-label'],  // Adding a class to the label for styling
            'constraints' => [
                new IsTrue([
                    'message' => "Vous devez accepter nos termes d'utilisation.",
                ]),
            ],
            'attr' => [
                'class' => 'form-check-input',  // Adding a class to the checkbox input for styling
            ],
        ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Mot de passe',  // Placeholder text
                    'class' => 'form-control border-0 p-4',
                    'autocomplete' => 'new-password',
                    'required' => true,
                    'autofocus' => true,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,  // Max length allowed by Symfony for security reasons
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
