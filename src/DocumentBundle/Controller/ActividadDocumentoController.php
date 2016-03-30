<?php

namespace DocumentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DocumentBundle\Entity\DocumentoActividad;
use DocumentBundle\Form\Type\DocumentoActividadType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

/**
 * Actividad controller.
 *
 * @Route("/actividad/documento")
 */
class ActividadDocumentoController extends Controller
{
    /**
     * Lists todas las actividades por curso.
     *
     * @Route("/curso/{curso_id}", name="actividad_por_curso")
     * @ParamConverter("curso", class="CursoBundle:Curso",options={"id" = "curso_id"})
     * @Method("GET")
     */
    public function actividadPorCursoAction($curso)
    {
        $em = $this->getDoctrine()->getManager();

        $actividadesPorCurso = $em->getRepository('DocumentBundle:Actividad')->findBy(['curso' => $curso]);

        return $this->render('DocumentBundle:DocumentoActividad:actividadPorCurso.html.twig', [
            'actividades' => $actividadesPorCurso,
            'curso' => $curso,
        ]);
    }
    /**
     * Creates a new Documento entity.
     *
     * @Route("/upload",name="documento_upload")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }
        $entity = new DocumentoActividad();
        $entity->setSubidoPor($usuario);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isValid()) {
            dump($form['documentFile']);
            foreach ($form['documentFile'] as $innerArray) {
                $this->setMultipleUpload($innerArray->getData());
            }
            $em->persist($entity);
            $em->flush();
        }

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/nuevo"	, name="upload_documento_view")
     *
     * @return [type] [description]
     */
    public function newDocumentoActividadAction()
    {
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }
        $entity = new DocumentoActividad();
        $form = $this->createCreateForm($entity);

        return $this->render('DocumentBundle:DocumentoActividad:newDocumentoActividad.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Creates a form to create a Documento entity.
     *
     * @param Documento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(DocumentoActividad $entity)
    {
        $form = $this->createForm(new DocumentoActividadType(), null, [
            'action' => $this->generateUrl('documento_upload'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Guardar']);

        return $form;
    }

    private function setMultipleUpload($array)
    {
        $em = $this->getDoctrine()->getManager();
        $i = 1;

        foreach ($array as $archivo) {
            $document = new DocumentoActividad();

            $document->setSubidoPor($this->getUser());
            $document->setDocumentFile($archivo);

            $em->persist($document);

            ++$i;
        }
        $em->flush();

        return $i;
    }
}
