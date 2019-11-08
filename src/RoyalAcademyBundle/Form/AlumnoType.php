<?php

namespace RoyalAcademyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AlumnoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, array(
                        'label' => 'Nombre y Apellido: '))
                ->add('dni', IntegerType::class, array(
                        'label' => 'Documento de Identidad: '))
                ->add('edad',IntegerType::class, array(
                        'label' => 'Edad: '))
                ->add('sexo', ChoiceType::class,[
                    'choices'  => [
                        'Masculino' => 'M',
                        'Femenino' => 'F',
                    ],
                    'label' => 'Genero: ',
                ])
                ->add('sedesede', EntityType::class, [
                        'class' => 'RoyalAcademyBundle:Sede',
                        'choice_label' => 'nombre',
                        'label' => 'Sede: ',]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RoyalAcademyBundle\Entity\Alumno'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'royalacademybundle_alumno';
    }


}
