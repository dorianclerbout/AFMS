<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control border-0 p-4'
                ]
    
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control border-0 p-4'
                ]
    
            ])
            ->add('phone', TextType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'class' => 'form-control border-0 p-4'
                ]
    
            ])
            ->add('email', EmailType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control border-0 p-4'
                ]
    
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
