<?php

namespace CursoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CursoBundle\Entity\Curso;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use CursoBundle\Form\Type\BuscarType;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * AsignacionController.
 *
 * @author  Pablo Díaz fcpauldiaz@me.com
 */
class AsignacionController extends Controller
{
    /**
     * Método que verifica que solo los cursos no asignados de un usuario.
     *
     * @param [Array] $cursos          [Recibe todos los cursos disponibles]
     * @param [Array] $cursosAsignados [Recibe los cursos asignados]
     *
     * @return [Array] [Devuelve los cursos no asignados]
     */
    private function revisarCursosOrdenados($cursos, $cursosAsignados)
    {
        $returnData = [];
        foreach ($cursos as $curso) {
            if (!$cursosAsignados->contains($curso)) {
                $returnData[] = $curso;
            }
        }

        return $returnData;
    }

    /**
     * Método para agregar un curso a un usuario de forma lógica (base de datos).
     *
     * @Route("/agregar/curso/{curso_slug}/", name="add_asignacion")
     */
    public function agregarCursoAction($curso_slug)
    {
        $em = $this->getDoctrine()->getManager();

        $curso = $em->getRepository('CursoBundle:Curso')->findOneBy(['slug' => $curso_slug]);
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }
        $em = $this->getDoctrine()->getManager();

        $cursosAsignados = $usuario->getCursos();
        if ($cursosAsignados->contains($curso)) {
            $this->get('braincrafted_bootstrap.flash')->error(sprintf('Error: El curso %s ya está asignado', $curso->getNombreCurso()));

            return $this->redirect(
                $this->generateUrl(
                    'listar_cursos',
                    ['username' => $usuario->getUsername()]
                )
            );
        }

        $usuario->addCurso($curso);
        $em->persist($usuario);
        $em->flush();

        $this->get('braincrafted_bootstrap.flash')->success(sprintf('Curso %s asignado correctamente', $curso->getNombreCurso()));

        return $this->redirect(
            $this->generateUrl(
                'listar_cursos',
                ['username' => $usuario->getUsername()]
            )
        );
    }

    /**
     * @Route("/asignar/cursos/", name="buscar_cursos")
     */
    public function buscarCursoAction(Request $request)
    {
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }

        $form = $this->createForm(
            new BuscarType());

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return $this->render(
                'CursoBundle:Asignacion:crearAsignacion.html.twig',
                [
                    'cursos' => [],
                    'buscarCurso' => $form->createView(),
                ]
            );
        }
        $data = $form->getData();
        $curso = $data['curso'];
        $carrera = $data['carreras'];
        $periodo = $data['periodo'];
        $catedratico = $data['catedratico'];
        $año = $data['year'];
        $sede = $data['sede'];
        $repositoryCurso = $this->getDoctrine()->getRepository('CursoBundle:Curso');
        $qb = $repositoryCurso->createQueryBuilder('curso');
        if (isset($curso) || isset($carrera)) {
            $qb
                ->select('curso')
                ->orderBy('curso.nombreCurso', 'ASC');
        }

        if (isset($curso)) {
            $qb
                ->Where('curso.nombreCurso LIKE :nombre')
                ->setParameter('nombre', '%'.$curso.'%');
        }
        if (isset($carrera)) {
            $qb
                ->andWhere('curso.carreras = :carrera')
                ->setParameter('carrera', $carrera);
        }
        if (isset($periodo)) {
            $qb
                ->andWhere('curso.periodo = :periodo')
                ->setParameter('periodo', $periodo);
        }
        if (isset($catedratico)) {
            $qb
                ->andWhere('curso.cursoCreadoPor = :catedratico')
                 ->setParameter('catedratico', $catedratico);
        }
        if (isset($año)) {
            $qb
                ->andWhere('curso.year = :year')
                ->setParameter('year', $año);
        }
        if (isset($sede)) {
            $qb
                ->andWhere('curso.sede = :sede')
                ->setParameter('sede', $sede);
        }

        $cursos = $qb->getQuery()->getResult();

        if (count($cursos) < 1) {
            $this->get('braincrafted_bootstrap.flash')->alert('No se encontraron cursos con los parámetros ingresados');
        } else {
            $this->get('braincrafted_bootstrap.flash')->success(sprintf('Se encontraron %s cursos con los parámetros ingresados', count($cursos)));
        }

        return $this->render(
            'CursoBundle:Asignacion:crearAsignacion.html.twig',
            [
                'cursos' => $cursos,
                'buscarCurso' => $form->createView(),
            ]
        );
    }

    /**
     * Listar cursos asignados.
     *
     * @Route("/listar/cursos", name="listar_cursos")
     */
    public function listarAction()
    {
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }

        return $this->render(
            'CursoBundle:Asignacion:listarAsignacion.html.twig',
            ['cursosAsignados' => $usuario->getCursos()]
        );
    }

    /**
     * Listar cursos asignados.
     *
     * @Route("/listar/cursos/catedratico", name="listar_cursos_catedratico")
     * @Security("is_granted('ROLE_CATEDRATICO')")
     */
    public function listarCursosCatedraticoAction()
    {
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }

        $repositoryCurso = $this->getDoctrine()->getRepository('CursoBundle:Curso');
        $cursos = $repositoryCurso->createQueryBuilder('curso')
            ->select('curso')
            ->orderBy('curso.nombreCurso', 'ASC')
            ->Where('curso.cursoCreadoPor = :catedratico')
            ->setParameter('catedratico', $usuario)
            ->getQuery()
            ->getResult();

        return $this->render(
            'CursoBundle:Asignacion:listarCursosAsignacion.html.twig',
            ['cursosAsignados' => $cursos]
        );
    }

    /**
     * @Route("/listar/{curso_slug}/catedratico", name="estudiantes_por_curso")
     * @Security("is_granted('ROLE_CATEDRATICO')")
     */
    public function listarEstudiantesPorCurso($curso_slug)
    {
        $em = $this->getDoctrine()->getManager();

        $curso = $em->getRepository('CursoBundle:Curso')->findOneBy(['slug' => $curso_slug]);

        $usuarios = $curso->getUsuarios();
        $estudiantes = [];
        foreach ($usuarios as $usuario) {
            if ($usuario->hasRole('ROLE_CATEDRATICO') === false) {
                $estudiantes[] = $usuario;
            }
        }

        return $this->render(
            'CursoBundle:Asignacion:listarEstudiantes.html.twig',
            ['estudiantes' => $estudiantes, 'curso' => $curso]
        );
    }

    /**
     * [Método para desasignar cursos ]
     * Método para remover curso asignado al usuario.
     *
     * @Route("/quitar/curso/{curso_id}/",name="remove_curso")
     * @ParamConverter()
     * @ParamConverter("curso", class="CursoBundle:Curso", options={"id"="curso_id"})
     *      */
    public function removeCursoAction(Curso $curso)
    {
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        if (!is_object($usuario) || !$usuario instanceof UserInterface) {
            throw new AccessDeniedException('El usuario no tiene acceso.');
        }
        $em = $this->getDoctrine()->getManager();
        $usuario->removeCurso($curso);
        $em->persist($usuario);
        $em->flush();

        return $this->redirect(
            $this->generateUrl(
                'listar_cursos',
                ['username' => $usuario->getUsername()]
            )
        );
    }

    /**
     * [Método para desasignar cursos a un estudiante por parte de un catedrático]
     * Método para remover curso asignado al usuario.
     *
     * @Route("/quitar/{curso_slug}/{usuario_id}/",name="remove_curso_estudiante")
     * @Security("is_granted('ROLE_CATEDRATICO')")
     * @ParamConverter("usuario", class="UserBundle:Usuario", options={"id"="usuario_id"})
     *      */
    public function removeCursoEstudianteAction($usuario, $curso_slug)
    {
        $em = $this->getDoctrine()->getManager();

        $curso = $em->getRepository('CursoBundle:Curso')->findOneBy(['slug' => $curso_slug]);
        $usuario->removeCurso($curso);
        $em->persist($usuario);
        $em->flush();

        $this->get('braincrafted_bootstrap.flash')->alert(sprintf('Estudiante s% removido', $usuario->__toString()));

        return $this->redirect(
            $this->generateUrl(
                'estudiantes_por_curso',
                ['curso_slug' => $curso->getSlug()]
            )
        );
    }
}
