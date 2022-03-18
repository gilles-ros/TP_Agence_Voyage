<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('ville')
            ->add('cp')
            ->add('tel')
            // ->add('roles')
            
        ;

        if ($options['edit'] == false){
            $builder
            ->add('password', PasswordType::class,[
                'required' => false,
                    'label' => 'Mot de Passe',
                    'attr' => [
                        'placeholder' => 'Votre Mot de Passe'
                ]])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
            'edit' =>false
        ]);
    }
}
