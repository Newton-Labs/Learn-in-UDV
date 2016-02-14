<?php

namespace DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Documento controller.
 *
 * @Route("/download")
 */
class DownloadController extends Controller
{
    /**
     * [showCursosParcialesAction Mostrar los cursos para descargar parciales].
     *
     * @return [Array] [cursos asignados]
     * @Route("/cursos/",name="cursos_show")
     * @Method("GET")
     * @Template("DocumentBundle:Documento:downloadDocumento.html.twig")
     */
    public function showCursosAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $usuario = $this->getUser();

        $cursos = $usuario->getCursos();

        return ['cursos' => $cursos];

    
    }


    /**
     * Finds and displays a Curso entity.
     *
     * @Route("/{slug}", name="show_curso")
     * @Method("GET")
     * @Template("DocumentBundle:Documento:cursoShow.html.twig")
     * @ParamConverter("curso", class="CursoBundle:Curso",options={"slug" = "slug"})
     */
    public function showAction($curso)
    {
        if (!$curso) {
            throw $this->createNotFoundException('Unable to find Curso entity.');
        }

        return [
            'curso' => $curso,
        ];
    }
}
