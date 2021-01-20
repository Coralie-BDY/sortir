<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la  sortie : ',
                'required'=>true
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => true,
                'label' => 'Date et heure de la sortie : '
            ])
            ->add('duree', NumberType::class, [
                'label' => 'Durée',
                'required' => false
            ])
            ->add('clotureinscription', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                'label' => 'Clôture des inscriptions : '
            ])
            ->add('maxinscrits', NumberType::class, [
                'required' => true,
                'label' => 'Nombre de places'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description et infos : ',
                'required' => false
            ])
            ->add('campus', EntityType::class, [
                'class'=>Campus::class,
                'required'=>true,
                'choice_label'=>'campus',
                'label' => 'Campus : '
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
