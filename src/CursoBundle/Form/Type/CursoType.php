<?php

namespace CursoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CursoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreCurso')
            ->add('sede', 'choice', [
                'choices' => [
                    'Zona 4 Central' => 'Zona 4 Central',
                    'Zona 4 Edificio Mini' => 'Zona 4 Edificio Mini',
                    'Zona 10' => 'Zona 10',
                    'Huehuetenango' => 'Huehuetenango',
                    'Quetzaltenango' => 'Quetzaltenango',
                    ],
                'attr' => [
                    'class' => 'select2',
                    ],
                'required' => true,
                'placeholder' => 'Seleccionar Sede',

                ])
             ->add('seccion', 'entity', [
                'empty_value' => 'Seleccionar Seccion',
                'class' => 'CursoBundle:Seccion',
                'label' => 'Escoger Sección',
                'required' => true,
                'attr' => [
                    'class' => 'select2',
                    ],
            ])
            ->add('clase', 'entity', [
                'empty_value' => 'Seleccionar Salón',
                'class' => 'CursoBundle:Clase',
                'label' => 'Seleccionar Salón',
                'required' => true,
                'attr' => [
                    'class' => 'select2',
                ],
            ])
            ->add('horario', 'entity', [
                'empty_value' => 'Seleccionar Horario',
                'class' => 'CursoBundle:Horario',
                'label' => 'Seleccionar Horario',
                'required' => true,
                'attr' => [
                    'class' => 'select2',
                ],
            ])
            ->add('carreras', 'entity', [
                'empty_value' => 'Seleccionar carrera',
                'class' => 'CursoBundle:Carrera',
                'property' => 'toStringCarreraYFacultad',
                'label' => 'Buscador de Carrera',
                'required' => true,
                'attr' => [
                    'class' => 'select2',
                    ],
                ])
            ->add('periodo', 'entity', [
                'label' => 'Período',
                'empty_value' => 'Seleccionar un Período',
                'required' => true,
                'class' => 'CursoBundle:Periodo',
                'attr' => [
                        'class' => 'select2',
                    ],
            ])
             ->add('year', 'date', [
                'label' => 'Fecha',
                'input' => 'datetime',
                'widget' => 'choice',
                'required' => true,
                'disabled' => true,
                'model_timezone' => 'America/Guatemala',
                'view_timezone' => 'America/Guatemala',
                'format' => 'dd-MMM-yyyy',
                'data' => new \DateTime(),

            ])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'CursoBundle\Entity\Curso',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_curso';
    }
}
