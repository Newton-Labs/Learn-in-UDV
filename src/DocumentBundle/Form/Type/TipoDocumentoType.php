<?php

namespace DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TipoDocumentoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreTipo')
            ->add('fechaCreacion', 'date', [
                    'label' => 'Fecha',
                    'input' => 'datetime',
                    'widget' => 'choice',
                    'disabled' => true,
                    'model_timezone' => 'America/Guatemala',
                    'view_timezone' => 'America/Guatemala',
                    'format' => 'dd-MMM-yyyy',
                    'data' => new \DateTime(),

                ])
        ;
    }

   /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DocumentBundle\Entity\TipoDocumento',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'documentbundle_tipodocumento';
    }
}
