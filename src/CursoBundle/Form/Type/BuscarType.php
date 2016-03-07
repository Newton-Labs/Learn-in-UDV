<?php

namespace CursoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class BuscarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('curso', 'entity', [
                    'empty_value' => 'Seleccione el curso',
                    'class' => 'CursoBundle:Curso',
                    'label' => 'Buscar por Nombre',
                    'choice_label' => 'nombreCurso',
                    'attr' => [
                        'class' => 'select2',
                    ],
                    'required' => false,
                ])
            ->add('carreras', 'entity', [
                'empty_value' => 'Seleccionar Carrera',
                'class' => 'CursoBundle:Carrera',
                'property' => 'toStringCarreraYFacultad',
                'label' => 'Buscador de Carrera',
                'attr' => [
                    'class' => 'select2',
                ],
                'required' => false,
            ])
            ->add('periodo', 'entity', [
                'empty_value' => 'Seleccionar curso',
                'class' => 'CursoBundle:Periodo',
                'label' => 'Buscador de Período',
                'attr' => [
                    'class' => 'select2',
                ],
                 'required' => false,
            ])
            ->add('catedratico', 'entity', [
                'empty_value' => 'Seleccionar Catedrático',
                'class' => 'UserBundle:Usuario',
                'query_builder' => function (EntityRepository $er) {
                    $role = 'ROLE_CATEDRATICO';

                    return $er->createQueryBuilder('usuario')
                        ->select('usuario')
                        ->where('usuario.roles LIKE :roles')
                        ->setParameter('roles', '%"'.$role.'"%');
                },
                'label' => 'Buscador de Catedráticos',
                'attr' => [
                    'class' => 'select2',
                ],
                 'required' => false,
            ])
            ->add('year', 'choice', [
                'empty_value' => 'Seleccionar Año',
                'choices' => [
                    2015 => 2015,
                    2016 => 2016,
                    2017 => 2017,
                    2018 => 2018,
                    2019 => 2019,
                    2020 => 2020,
                    2021 => 2021,
                ],
                'label' => 'Buscador de Año',
                'attr' => [
                    'class' => 'select2',
                ],
                 'required' => false,
            ])
           ->add('sede', 'choice', [
                'choices' => [
                    'Zona 4' => 'Zona 4',
                    'Zona 10' => 'Zona 10',
                    'Huehuetenango' => 'Huehuetenango',
                    'Quetzaltenango' => 'Quetzaltenango',
                    ],
                'attr' => [
                    'class' => 'select2',
                    ],
                'placeholder' => 'Seleccionar Sede',
                 'required' => false,

            ])
           ->add('submit', 'submit', ['label' => 'Buscar', 'attr' => ['class' => 'btn btn-block']])
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_curso';
    }
}
