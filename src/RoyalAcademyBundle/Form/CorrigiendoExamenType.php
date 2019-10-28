<?php

namespace RoyalAcademyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CorrigiendoExamenType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cantidadDeRespuestasNecesariasParaAprobar', IntegerType::class, [
            'attr' => ['class' => 'tinymce', 'scale' =>0, 'min' =>1 , 'max' =>50 ]
        ]);
        
        /*
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();

                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                if ($data){
                    $examenElegido = $data->getExamen();
                    $fechas = null === $examenElegido ? [] : $examenElegido->getFechas();

                    $form->add('fechas', EntityType::class, [
                        'class' => 'App\Entity\Fechaexamen',
                        'placeholder' => '',
                        'choices' => $fechas,
                    ]);
                }
            }
        );
        */
        
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'royalacademybundle_corrigiendoexamen';
    }


}
