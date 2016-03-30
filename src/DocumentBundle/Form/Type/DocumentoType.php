<?php

namespace DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use UserBundle\Entity\Usuario;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints;

class DocumentoType extends AbstractType
{
    private $usuario;
    private $editBoolean = true;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          //  ->add('documentName',null,['label'=>'Nombre del Documento'])
            ->add('tipoDocumento', 'entity', [
                'class' => 'DocumentBundle:TipoDocumento',
                'empty_value' => 'Seleccione el tipo de documento',
                'constraints' => [
                    new NotNull(),
                ],

            ])
            ->add('mensaje', 'textarea', [
              'label' => 'Mensaje que desea agregar (opcional)',
              'required' => false,
            ])
            ->add('mandarCorreo', 'choice', [
              'label' => '¿Desea mandar un correo a los estudiantes de aviso?',
                'choices' => array(
                   0 => 'No',
                   1 => 'Sí',
              ),
              'expanded' => true,
              'required' => true,

            ])

           ;
        if ($this->editBoolean === true) {
            $builder->add('documentFile', 'file', ['label' => false,
                'attr' => ['class' => 'filestyle', 'data-buttonBefore' => true],
                'multiple' => true,
                ]);
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'constraints' => new Callback([$this, 'validarEnvioMensaje']),
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'documentbundle_documento';
    }
    /**
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param bool
     */
    public function setEditBoolean($param)
    {
        $this->editBoolean = $param;
    }

    /**
     * Validar que la fecha de ingreso sea antes que la fecha de salida.
     *
     * @param Array                     $data    contiene los datos del formulario
     * @param ExecutionContextInterface $context
     */
    public function validarEnvioMensaje($data, ExecutionContextInterface $context)
    {
        if ($data['mandarCorreo'] == 1 && $data['mensaje'] == null) {
            $context->buildViolation('Si desea mandar un correo debe adjuntar un mensaje')
                ->atPath('documento_new')
                ->addViolation();
        }
    }
}
