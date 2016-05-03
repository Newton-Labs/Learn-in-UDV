<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $builder->getData();
        // agregar campos personalizados
        $builder
            ->add('nombre', null, ['label' => false,
            'attr' => [
            'placeholder' => 'Nombre/s',
                 ],

            ])
            ->add('apellidos', null, ['label' => false,
                'attr' => [
                    'placeholder' => 'Apellidos',
                    ],
                ])
            ->add('username', null, [
                'label' => false, 'translation_domain' => 'FOSUserBundle',
                'constraints' => [
                    new Callback([$this, 'validarNombreUsuario']),
                ],
            ])
            ->add('email', 'email', ['label' => false, 'translation_domain' => 'FOSUserBundle'])
            ->add('plainPassword', 'repeated', [
                'label' => false,
                'type' => 'password',
                'options' => ['translation_domain' => 'FOSUserBundle'],
                'first_options' => ['label' => false],
                'second_options' => ['label' => false],
                'invalid_message' => 'fos_user.password.mismatch',
            ])
            ->add('carnet', null, [
                'label' => false,
                'required' => false,
            ])
            ->add('tipoUsuario', 'choice', [
                'label' => false,
                'choices' => [
                    0 => 'Estudiante',
                    1 => 'Catedrático',
                ],
                'required' => true,

                ])

            ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            [$this, 'onPostData']
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation' => ['registration'],
            'constraints' => new Callback([$this, 'validarTipoUsuario']),
        ]);
    }
    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'user_registration';
    }

    /**
     * Forma de validar el correo de un catedrático.
     *
     * @param FormEvent $event Evento después de mandar la información del formulario
     */
    public function onPostData(FormEvent $event)
    {
        $usuario = $event->getData();
        $form = $event->getForm();

        if ($form['carnet']->getData() == null
            &&
            $form['tipoUsuario']->getData() == 1
         ) {
            $usuario->addRole('ROLE_CATEDRATICO');
        }
    }

    /**
     * Validar que la fecha de ingreso sea antes que la fecha de salida.
     *
     * @param Array                     $data    contiene los datos del formulario
     * @param ExecutionContextInterface $context
     */
    public function validarTipoUsuario($data, ExecutionContextInterface $context)
    {
        if ($data->getTipoUsuario() == 0 && $data->getCarnet() == null) {
            $context->buildViolation('Es necesario un número de carnet o un número de identificación')
                ->atPath('fos_user_registration_register')
                ->addViolation();
        }
    }

    /**
     * Validar que el nombre de usuario no tenga espacios en blanco.
     *
     * @param Array                     $data    contiene los datos del formulario
     * @param ExecutionContextInterface $context
     */
    public function validarNombreUsuario($username, ExecutionContextInterface $context)
    {
        if (preg_match('/\s/', $username)) {
            $context->buildViolation('El nombre de usuario no puede tener espacios en blanco')
                ->atPath('fos_user_registration_register')
                ->addViolation();
        }
    }
}
