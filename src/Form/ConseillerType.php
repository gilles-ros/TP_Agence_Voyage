<?php

namespace App\Form;

use App\Entity\Conseiller;
use App\Entity\Destination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ConseillerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('nom')
            ->add('prenom')
            ->add('photoFile', VichImageType::class, [
                'required' => false,
                'label' => 'photo',
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => true
            ])

            ->add('referent', ChoiceType::class, array(
                'choices' => array(
                    'Yes' => true,
                    'No' => false
                ),
                'required' => true,
            ))

            ->add('description')
            ->add('specialite',EntityType::class,[
                'class' => Destination::class,
                'choice_label' => 'titre'
            ])

            // ->add('maj')
            ->add('password', PasswordType::class,[
                'required' => false,
                'label' => 'Mot de Passe',
                'attr' => [
                    'placeholder' => 'Votre Mot de Passe'
                    ]])
            ->add("roles", ChoiceType::class, [
                'choices' => [
                    'conseiller' => "ROLE_ADMIN",
                ],
                'multiple' => true,
                'expanded' => true
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conseiller::class,
        ]);
    }
}
