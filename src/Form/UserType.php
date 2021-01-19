<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, [
                'label'=> 'Pseudo : '
            ])
            ->add('prenom', TextType::class, [
                'label'=>'Prénom : '
            ])
            ->add('nom', TextType::class, [
                'label'=>'Nom : '
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone : '
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email : '
            ])
            ->add('password',RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label'=> 'Mot de passe : '),
                'second_options' => array('label'=>'Confirmer le mot de passe : '),
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                //TODO: regex pour le password
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Mot de passe obligatoire',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ))
            ->add('campus',EntityType::class, [
                'class'=>Campus::class,
                'required'=>true,
                'choice_label'=>'campus',
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
