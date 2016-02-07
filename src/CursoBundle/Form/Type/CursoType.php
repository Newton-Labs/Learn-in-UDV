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
            ->add('sede','choice',[
                'choices' => [
                    'Zona 4' => 'Zona 4',
                    ],
                'attr' => [
                    'class' => 'select2'
                    ],
                'placeholder' => 'Seleccionar Sede'

                ])
            ->add('carreras','entity',[
                'empty_value' => 'Seleccionar carrera',
                'class' => 'CursoBundle:Carrera',
                'property' => 'toStringCarreraYFacultad',
                'label' => 'Buscador de Carrera',
                'attr' => [
                    'class' => 'select2',
                    ],
                ])
            ->add('periodo','entity',[
                'empty_value' => 'Seleccionar un Período',
                'class' => 'CursoBundle:Periodo',
                'attr' => [
                        'class' => 'select2'
                    ]


            ])
            ->add('year',null, [
                'label' => 'Fecha',
                'attr' => [
                    'readonly' => true
                    ]

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
