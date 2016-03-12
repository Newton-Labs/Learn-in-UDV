<?php

namespace ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use ContactBundle\Entity\Contact;
use FOS\UserBundle\Model\UserInterface;
use ContactBundle\Form\Type\ContactType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @author  fcpauldiaz <fcpauldiaz@gmail.com>
 * @Route("/contact")
 */
class ContactController extends Controller
{
    /**
     * @Route("/access/exception", name="403_exception")
     */
    public function exceptionAction(Request $request)
    {
        return $this->render('default/error403.html.twig');
    }

    /**
     * @Route("/send",name ="send_email")
     * @Template("ContactBundle:Contact:showContact.html.twig")
     */
    public function enviarCorreoAction(Request $request)
    {
        $entity = new Contact();
        $form = $this->createCreateFormAction($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $varNombre = $form->get('nombre')->getData();
            $varCorreo = $form->get('correo')->getData();
            $varAsunto = $form->get('asunto')->getData();
            $varMensaje = $form->get('mensaje')->getData();

            $message = \Swift_Message::newInstance()

              ->setFrom([$varCorreo => $varNombre])
              ->setTo('soporte@newtonlabs.com.gt')
              ->setSubject($varAsunto)
              ->setBody(
                $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                    'ContactBundle:Contact:contactEmail.html.twig',
                    ['contenido' => $varMensaje, 'nombre' => $varNombre, 'correo' => $varCorreo]
                ),
                'text/html'
            )

            ;

            $this->get('mailer')->send($message);

            return $this->redirect(
                $this->generateUrl(
                    'homepage'
                )
            );
        }

        return [
            'form' => $form->createView(),
        ];
    }
    /**
     * @return [type] [description]
     */
    public function createCreateFormAction(Contact $entity)
    {
        $form = $this->createForm(new ContactType(), $entity, [
            'action' => $this->generateUrl('send_email'),

        ]);

        return $form;
    }

    /**
     * Displays a form to create a new Contact entity.
     *
     * @Route("/",name="contact")
     * @Method("GET")
     * @Template("ContactBundle:Contact:showContact.html.twig")
     */
    public function showContactAction()
    {
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }

        $form = $this->createCreateFormAction(new Contact());

        return [
            'form' => $form->createView(),
            'nombreUsuario' => $usuario->getNombre(),
            'correoUsuario' => $usuario->getEmail(),
        ];
    }
}
