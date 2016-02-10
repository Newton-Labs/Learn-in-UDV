<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
            ->add('username', null, ['label' => false, 'translation_domain' => 'FOSUserBundle'])
            ->add('email', 'email', ['label' => false, 'translation_domain' => 'FOSUserBundle'])
            ->add('plainPassword', 'repeated', [
                'label' => false,
                'type' => 'password',
                'options' => ['translation_domain' => 'FOSUserBundle'],
                'first_options' => ['label' => false],
                'second_options' => ['label' => false],
                'invalid_message' => 'fos_user.password.mismatch',
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

    public function onPostData(FormEvent $event)
    {
        $usuario = $event->getData();
        if (preg_match('/[a-z\'0-9]+([._-][a-z\'0-9]+)*@([udv]+[.]+[edu]+[.]+[gt]+)/', $usuario->getEmail())) {
            $usuario->addRole('ROLE_CATEDRATICO');
        }
    }
}
