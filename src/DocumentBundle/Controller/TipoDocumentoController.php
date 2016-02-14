<?php

namespace DocumentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DocumentBundle\Entity\TipoDocumento;
use DocumentBundle\Form\Type\TipoDocumentoType;

/**
 * TipoDocumento controller.
 *
 * @Route("/tipodocumento")
 */
class TipoDocumentoController extends Controller
{
    /**
     * Lists all TipoDocumento entities.
     *
     * @Route("/", name="tipodocumento")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DocumentBundle:TipoDocumento')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TipoDocumento entity.
     *
     * @Route("/", name="tipodocumento_create")
     * @Method("POST")
     * @Template("DocumentBundle:TipoDocumento:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoDocumento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipodocumento_new'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoDocumento entity.
     *
     * @param TipoDocumento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoDocumento $entity)
    {
        $form = $this->createForm(new TipoDocumentoType(), $entity, array(
            'action' => $this->generateUrl('tipodocumento_create'),
            'method' => 'POST',
        ));

        $form->add('submit_button', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoDocumento entity.
     *
     * @Route("/new", name="tipodocumento_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoDocumento();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoDocumento entity.
     *
     * @Route("/{id}", name="tipodocumento_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocumentBundle:TipoDocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoDocumento entity.
     *
     * @Route("/{id}/edit", name="tipodocumento_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocumentBundle:TipoDocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
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
     * Creates a form to edit a TipoDocumento entity.
     *
     * @param TipoDocumento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(TipoDocumento $entity)
    {
        $form = $this->createForm(new TipoDocumentoType(), $entity, array(
            'action' => $this->generateUrl('tipodocumento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoDocumento entity.
     *
     * @Route("/{id}", name="tipodocumento_update")
     * @Method("PUT")
     * @Template("DocumentBundle:TipoDocumento:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DocumentBundle:TipoDocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipodocumento_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoDocumento entity.
     *
     * @Route("/{id}", name="tipodocumento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DocumentBundle:TipoDocumento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoDocumento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipodocumento'));
    }

    /**
     * Creates a form to delete a TipoDocumento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipodocumento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
