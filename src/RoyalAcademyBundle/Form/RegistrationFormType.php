<?php

namespace RoyalAcademyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('email');
        $builder->remove('username');
        $builder->remove('plainPassword');
        $builder
            ->add('email', EmailType::class, array('label' => 'Email:'))
            ->add('username', null, array('label' => 'Usuario: '))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'Contraseña: '),
                'second_options' => array('label' => 'Repita contraseña: '),
                'invalid_message' => 'Las contraseñas no coinciden',
            ))
        ;
    }
    public function getParent() {
        return BaseRegistrationFormType::class;
    }
}