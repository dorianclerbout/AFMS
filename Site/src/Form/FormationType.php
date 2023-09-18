<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => false,
            'required' => true,
            'attr' => ['class' => 'form-control col-md-7 col-xs-12'],
        ])
        ->add('time', TextType::class, [
            'label' => false,
            'required' => true,
            'attr' => ['class' => 'form-control col-md-7 col-xs-12'],
        ])
        ->add('description', TextType::class, [
            'label' => false,
            'required' => true,
            'attr' => ['class' => 'form-control col-md-7 col-xs-12'],
        ])
        ->add('people', TextType::class, [
            'label' => false,
            'required' => true,
            'attr' => ['class' => 'form-control col-md-7 col-xs-12'],
        ])
        ->add('categorie', ChoiceType::class, [
            'choices' => [
                'Agent de surveillance' => 'Agent de surveillance',
                'SSIAP' => 'SSIAP',
                'Secourisme' => 'Secourisme',
                'Habilitations électriques' => 'Habilitations électriques',
                'Incendie' => 'Incendie',
            ],
            'label' => false,
            'attr' => ['class' => 'form-control col-md-7 col-xs-12', 'required' => true],
        ])
        ->add('image', FileType::class, [
            'label' => false,
            'required' => false, // Peut être changé en fonction de vos besoins
            'attr' => ['class' => 'form-control col-md-7 col-xs-12'],
            'mapped' => false, // Indique que ce champ ne doit pas être mappé directement à l'entité
        ])
        ->add('imageFileName', HiddenType::class, [
            'mapped' => false,
        ])
        
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
