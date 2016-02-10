<?php

namespace CursoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CursoBundle\Entity\Facultad;
use CursoBundle\Form\Type\FacultadType;

/**
 * Facultad controller.
 *
 * @Route("/facultad")
 */
class FacultadController extends Controller
{
    /**
     * Lists all Facultad entities.
     *
     * @Route("/", name="facultad")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CursoBundle:Facultad')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Facultad entity.
     *
     * @Route("/", name="facultad_create")
     * @Method("POST")
     * @Template("CursoBundle:Facultad:newFacultad.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Facultad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facultad_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Facultad entity.
     *
     * @param Facultad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Facultad $entity)
    {
        $form = $this->createForm(new FacultadType(), $entity, array(
            'action' => $this->generateUrl('facultad_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Facultad entity.
     *
     * @Route("/new", name="facultad_new")
     * @Method("GET")
     * @Template()
     */
    public function newFacultadAction()
    {
        $entity = new Facultad();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Facultad entity.
     *
     * @Route("/{id}", name="facultad_show")
     * @Method("GET")
     * @Template("CursoBundle:Facultad:showFacultad.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CursoBundle:Facultad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facultad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Facultad entity.
     *
     * @Route("/{id}/edit", name="facultad_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CursoBundle:Facultad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facultad entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Facultad entity.
     *
     * @param Facultad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Facultad $entity)
    {
        $form = $this->createForm(new FacultadType(), $entity, array(
            'action' => $this->generateUrl('facultad_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Facultad entity.
     *
     * @Route("/{id}", name="facultad_update")
     * @Method("PUT")
     * @Template("CursoBundle:Facultad:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CursoBundle:Facultad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facultad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('facultad_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Facultad entity.
     *
     * @Route("/{id}", name="facultad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CursoBundle:Facultad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Facultad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('facultad'));
    }

    /**
     * Creates a form to delete a Facultad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facultad_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
