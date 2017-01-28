<?php

namespace ContactBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form to use as messenger.
 *
 * @author Pablo diaz pablodiaz@newtonlabs.com.gt
 */
class MessageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

           ->add('curso', 'entity', [
                'class' => 'CursoBundle:Curso',
                'label' => 'Curso a enviar mensaje',
            ])
           ->add('asunto', 'text', [
                'label' => 'Asunto del mensaje',
            ])
           ->add('mensaje', 'textarea', [
                'attr' => [
                    'placeholder' => 'Mensaje a enviar',
                ],
            ])

           ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        'data_class' => 'ContactBundle\Entity\Contact',
        'translation_domain' => 'MremiContactBundle',
    ));
    }

    public function getName()
    {
        return 'contact_type';
    }
}
