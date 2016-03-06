<?php

namespace DocumentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use UserBundle\Entity\Usuario;

class DocumentoType extends AbstractType
{
    private $usuario;
    private $editBoolean = true;

    public function __construct(Usuario  $user)
    {
        $this->usuario = $user;
    }
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
            ->add('mensaje', 'textarea',[
              'label' => 'Mensaje que desea agregar (opcional)',
              'required' => false,
            ])
            ->add('mandarCorreo','choice',[
              'label' => '¿Desea mandar un correo a los estudiantes de aviso?',
                'choices'  => array(
                   0 => 'No',
                   1 => 'Sí',
              ),
              'expanded' => true,
              'required' => true,
              'mapped' => false,

            ])
            ->add('curso', 'entity', [
                'class' => 'CursoBundle:Curso',
                'choices' => $this->getUsuario()->getCursos(),
                'empty_value' => 'Seleccione el curso del documento',

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
            'data_class' => 'DocumentBundle\Entity\Documento',
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
}
