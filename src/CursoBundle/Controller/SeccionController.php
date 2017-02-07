<?php

namespace CursoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CursoBundle\Entity\Seccion;
use CursoBundle\Form\Type\SeccionType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Seccion controller.
 *
 * @Route("/seccion")
 */
class SeccionController extends Controller
{
    /**
     * Lists all Seccion entities.
     *
     * @Route("/", name="seccion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seccions = $em->getRepository('CursoBundle:Seccion')->findAll();

        return $this->render('seccion/index.html.twig', array(
            'seccions' => $seccions,
        ));
    }

    /**
     * Creates a new Seccion entity.
     *
     * @Route("/new", name="seccion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $seccion = new Seccion();

        $form = $this->createForm(new SeccionType(), $seccion, array(
            'action' => $this->generateUrl('seccion_new'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seccion);
            $em->flush();
            $entities = $em->getRepository('CursoBundle:Seccion')->findAll();
            foreach ($entities as $entity) {
                $response1[] = [
                    'key' => $entity->__toString(),
                    // other fields
                ];
                $response2[] = [
                    'value' => $entity->getId(),
                    // other fields
                ];
            }

            return new JsonResponse(([$response1, $response2]));
        }

        return $this->render('CursoBundle:Seccion:ajaxSeccion.html.twig', array(
            'seccion' => $seccion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Seccion entity.
     *
     * @Route("/{id}", name="seccion_show")
     * @Method("GET")
     */
    public function showAction(Seccion $seccion)
    {
        $deleteForm = $this->createDeleteForm($seccion);

        return $this->render('seccion/show.html.twig', array(
            'seccion' => $seccion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Seccion entity.
     *
     * @Route("/{id}/edit", name="seccion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seccion $seccion)
    {
        $deleteForm = $this->createDeleteForm($seccion);
        $editForm = $this->createForm('CursoBundle\Form\SeccionType', $seccion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seccion);
            $em->flush();

            return $this->redirectToRoute('seccion_edit', array('id' => $seccion->getId()));
        }

        return $this->render('seccion/edit.html.twig', array(
            'seccion' => $seccion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Seccion entity.
     *
     * @Route("/{id}", name="seccion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Seccion $seccion)
    {
        $form = $this->createDeleteForm($seccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seccion);
            $em->flush();
        }

        return $this->redirectToRoute('seccion_index');
    }

    /**
     * Creates a form to delete a Seccion entity.
     *
     * @param Seccion $seccion The Seccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seccion $seccion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seccion_delete', array('id' => $seccion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
