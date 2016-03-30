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
                    'pickerPosition' => 'bottom-o',
                    'viewSelect' => 'month',
                    'showMeridian' => false,
                ],
                'read_only' => true,
                'label' => 'fecha de expiración',

            ])

            ->add('curso')
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
