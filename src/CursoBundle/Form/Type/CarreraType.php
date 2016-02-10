<?php

namespace CursoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarreraType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreCarrera')
            ->add('facultad', 'entity', [
                'empty_value' => 'Seleccionar Facultad',
                'class' => 'CursoBundle:Facultad',
                'property' => 'nombreFacultad',
                'label' => 'Buscador de Facultad',
                'attr' => [
                    'class' => 'select2',
                ],

            ])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CursoBundle\Entity\Carrera',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cursobundle_carrera';
    }
}
