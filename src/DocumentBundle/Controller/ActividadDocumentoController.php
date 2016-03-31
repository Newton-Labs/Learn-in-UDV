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
 * @Route("/tareas")
 */
class ActividadDocumentoController extends Controller
{

     /**
     * Mostrar cursos para subir tareas
     *
     * @Route("/cursos/",name="tareas_cursos_show")
     * @Method("GET")
     * 
     */
    public function showCursosAction()
    {
        $usuario = $this->getUser();
         if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }

        $cursos = $usuario->getCursos();

        return $this->render('DocumentBundle:DocumentoActividad:tareasCursos.html.twig',
            [
                'cursos' => $cursos
            ]
        );
    }
    /**
     * Lists todas las actividades por curso.
     *
     * @Route("/curso/{slug}", name="actividad_por_curso")
     * @ParamConverter("curso", class="CursoBundle:Curso",options={"slug" = "curso_slug"})
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

        $form = $this->createCreateForm(null);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->setMultipleUpload($form->getData());
        }

        return $this->render('default/index.html.twig');
    }

    /**
     *  @Route("/nuevo/{actividad_id}"	, name="upload_documento_view")
     *  @ParamConverter("actividad", class="DocumentBundle:Actividad",options={"id" = "actividad_id"})
     *
     * @return [type] [description]
     */
    public function newDocumentoActividadAction(Request $request, $actividad)
    {
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }

        $form = $this->createCreateForm($actividad);
        $form->handleRequest($request);
        if (!$form->isValid()) {
            return $this->render('DocumentBundle:DocumentoActividad:newDocumentoActividad.html.twig', [
                'form' => $form->createView(),

            ]);
        }

        if ($form->isValid()) {
            $this->setMultipleUpload($form->getData(), $actividad);
        }

        return $this->redirect($this->generateUrl('homepage'));
    }

    /**
     * Creates a form to create a Documento entity.
     *
     * @param Documento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm($actividad)
    {
        $form = $this->createForm(new DocumentoActividadType($actividad), null, [
            'action' => $this->generateUrl('upload_documento_view', ['actividad_id' => $actividad->getId()]),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Guardar']);

        return $form;
    }

    private function setMultipleUpload($data, $actividad)
    {
        $em = $this->getDoctrine()->getManager();
        $i = 1;

        foreach ($data['documentFile'] as  $arrayFile) {
            foreach ($arrayFile as $file) {
                $document = new DocumentoActividad();

                $document->setSubidoPor($this->getUser());
                $document->setActividad($actividad);
                $document->setDocumentFile($file);
                $document->setMensajeEnvio($data['mensajeEnvio']);
                $em->persist($document);

                ++$i;
            }
        }
        $em->flush();

        return $i;
    }
    /**
     * @Route("/cursos/catedratico",name="cursos_catedratico")
     * @Method("GET")
     *
     */
    public function showCursosCatedraticoAction()
    {   
        $usuario = $this->getUser();
         if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }

        $cursos = $usuario->getCursos();

        return $this->render('DocumentBundle:DocumentoActividad:tareasCursosCatedratico.html.twig',
            [
                'cursos' => $cursos
            ]
        );
    }

    /**
     * Lists todas las actividades por curso.
     *
     * @Route("/curso/catedratico/{slug}", name="actividad_por_curso_catedratico")
     * @ParamConverter("curso", class="CursoBundle:Curso",options={"slug" = "curso_slug"})
     * @Method("GET")
     */
    public function actividadPorCursoCatedraticoAction($curso)
    {
         $em = $this->getDoctrine()->getManager();

        $actividadesPorCurso = $em->getRepository('DocumentBundle:Actividad')->findBy(
            [
                'curso' => $curso,
                'usuario' => $this->getUser(),
            ]
        );

        return $this->render('DocumentBundle:DocumentoActividad:actividadPorCursoCatedratico.html.twig', [
            'actividades' => $actividadesPorCurso,
            'curso' => $curso,
        ]);
    }
    /**
     * @Route("/listar/documentos/catedratico/{actividad_id}", name="listar_documentos_catedratico")
     * @Method("GET")
     * @ParamConverter("actividad", class="DocumentBundle:Actividad",options={"id" = "actividad_id"})
     */
    public function listarDocumentosAction($actividad)
    {
        $em = $this->getDoctrine()->getManager();

        $documentosActividad = $em->getRepository('DocumentBundle:DocumentoActividad')->findBy(
            [
                'actividad' => $actividad,
            ]
        );
        return $this->render('DocumentBundle:DocumentoActividad:mostrarDocumentos.html.twig',[
            'documentos' => $documentosActividad,
        ]);
    }


}
