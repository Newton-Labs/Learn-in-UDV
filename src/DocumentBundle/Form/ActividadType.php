<?php

namespace DocumentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActividadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreActividad')
            ->add('descripcionActividad', 'textarea', [
                'label' => 'Descripción de la actividad',
                'attr' => [
                    'rows' => '3',
                    'maxlength' => '255',
                ],
            ])
            ->add('fechaExpiracion', 'collot_datetime', ['pickerOptions' => [
                    'format' => 'mm/dd/yyyy HH:ii',
                    'weekStart' => 0,
                    'autoclose' => true,
                    'startView' => 'month',
                    'minView' => 'hour',
                    'maxView' => 'decade',
                    'todayBtn' => true,
                    'todayHighlight' => true,
                    'keyboardNavigation' => true,
                    'language' => 'es',
                    'forceParse' => false,
                    'minuteStep' => 5,
                    'pickerReferer ' => 'default', //deprecated
                    'pickerPosition' => 'top-left',
                    'viewSelect' => 'month',
                    'showMeridian' => false,
                ],
                'read_only' => true,
                'label' => 'fecha de expiración',
                'attr' => [
                    'placeholder' => 'Hacer clíck aquí para mostrar calendario',
                    'help_text' => 'Los estudiantes no podrán subir documentos después de esta fecha',
                ],

            ])

            ->add('curso', 'entity', [
                'class' => 'CursoBundle:Curso',
                'empty_value' => 'Seleccione el curso al que pertenece esta actividad',

                ])
            ->add('submit', 'submit', [
                    'label' => 'Guardar',
                    'attr' => [
                        'class' => 'btn btn-block',
                    ],

                ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DocumentBundle\Entity\Actividad',
        ));
    }
}
