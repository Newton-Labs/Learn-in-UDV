<?php

namespace CursoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CursoBundle\Entity\Horario;


class HorarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dia', 'choice', [
            'choices'  => Horario::horario,
            // *this line is important*
            'choices_as_values' => true,
            ])
            ->add('horaInicio', 'time', [
                
            ])
            ->add('horaFinal', 'time', [
                
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CursoBundle\Entity\Horario',
        ));
    }
}
