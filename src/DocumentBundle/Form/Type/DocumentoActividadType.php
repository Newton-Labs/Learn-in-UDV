<?php

namespace DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentoActividadType extends AbstractType
{
    private $actividad = null;

    public function __construct($actividad)
    {
        if (is_null($actividad)) {
            //do nothing
        } else {
            $this->actividad = $actividad;
        }
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('documentFile', 'bootstrap_collection', [
                    'type' => 'file',
                    'label' => 'Archivos',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'add_button_text' => 'Agregar Archivos',
                    'delete_button_text' => 'Eliminar Archivos',
                    'sub_widget_col' => 6,
                    'button_col' => 3,
                    'by_reference' => false, //esta linea también es importante para que se guarde la ref
                    'cascade_validation' => true,
                    'attr' => [
                            'class' => 'select2',
                        ],
                    'options' => [
                        'attr' => ['class' => 'filestyle', 'data-buttonBefore' => true],
                        'multiple' => true,
                    ],

                ])
            ->add('mensajeEnvio', 'textarea', [
                'label' => 'Comentarios Adicionales',
                'required' => false,

            ])
            ->add('actividad', 'entity', [
                'class' => 'DocumentBundle:Actividad',
                'data' => $this->actividad,
                'read_only' => true,
                'disabled' => true,

            ])

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }
}
