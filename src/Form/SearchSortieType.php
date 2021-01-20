<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\SearchSortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $inscription = ['Auquelles je suis inscrit/e' => true,
            'Auquelles je ne suis pas inscrit/e' => true];

        $builder
            ->add('campus', EntityType::class, [
                'class'=>Campus::class,
                'required'=>false,
                'choice_label'=>'campus'
            ])
            ->add('inscription', ChoiceType::class, [
                'label' => 'Sorties',
                'required' => false,
                'expanded' => true,
                'multiple' => true,
                'data' => array($inscription),
                'choices' => $inscription,
                'choice_attr' => array('checked'=>true)
            ])
            ->add('organisateur', CheckboxType::class, [
                'label' => 'Sortie dont je suis organisateur/trice',
                'required' => false,
                'data'=>true
            ])
            ->add('sortiePassee', CheckboxType::class, [
                'label' => 'Sorties passées',
                'required' =>false,
                'attr' =>[
                   'id'=>'checked',
                    'onclick'=>'check()'
                    ]
            ])
            ->add('nomSortie', TextType::class, [
                'required' => false,
                'label' => 'Nom sortie',
                'attr' => [
                    'placeholder' => 'Rechercher'
                    ]
                ])
            ->add('dateDebut',  DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('dateFin',  DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
        'label' => 'Rechercher',
        'attr' => [
            'class' => 'btn btn-info send-button tx-tfm',
            'type' => 'submit'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchSortie::class,
            'method' => 'get',
            'csrf_protection' => false,
//            'translation_domain' => 'forms'
        ]);
    }
}
