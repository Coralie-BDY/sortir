<?php

namespace App\Form;

use App\Entity\Lieu;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LieuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => 'Lieu : ',
                'attr' => [
                    'placeholder' => 'Musée',
                    'class' => 'form-control'
                ]
            ])
            ->add('adresse', TextType::class, [
                'required' => false,
                'label' => 'adresse : ',
                'attr' => [
                    'placeholder' => '5 rue de la place',
                    'class' => 'form-control'
                ]
            ])
            ->add('latitude', NumberType::class, [
                'required' => false,
                'label' => 'latitude : ',
                'attr' => [
                    'placeholder' => '0.123654789',
                    'class' => 'form-control'
                ]
            ])
            ->add('longitude', NumberType::class, [
                'required' => false,
                'label' => 'longitude : ',
                'attr' => [
                    'placeholder' => '9.874563210',
                    'class' => 'form-control'
                ]
            ])
//            ->add('ville', EntityType::class, [
//                'class'=> Ville::class,
//                'required'=> true,
//                'label'=> 'ville : '
//            ])

//            ->add('submit', SubmitType::class, [
//                'label' => 'Valider',
//                'attr' => [
//                    'class' => 'btn btn-info send-button tx-tfm',
//                    'type' => 'submit',
//                ],
//            ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lieu::class,
        ]);
    }
}
