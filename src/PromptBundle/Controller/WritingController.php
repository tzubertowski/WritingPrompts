<?php

namespace PromptBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PromptBundle\Entity\Writing;
use PromptBundle\Form\WritingType;

/**
 * Writing controller.
 *
 */
class WritingController extends Controller
{

    /**
     * Lists all Writing entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PromptBundle:Writing')->findAll();

        return $this->render('PromptBundle:Writing:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Writing entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Writing();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('writing_show', array('id' => $entity->getId())));
        }

        return $this->render('PromptBundle:Writing:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Writing entity.
     *
     * @param Writing $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Writing $entity)
    {
        $form = $this->createForm(new WritingType(), $entity, array(
            'action' => $this->generateUrl('writing_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Writing entity.
     *
     */
    public function newAction()
    {
        $entity = new Writing();
        $form   = $this->createCreateForm($entity);

        return $this->render('PromptBundle:Writing:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Writing entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PromptBundle:Writing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Writing entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PromptBundle:Writing:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Writing entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PromptBundle:Writing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Writing entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PromptBundle:Writing:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Writing entity.
    *
    * @param Writing $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Writing $entity)
    {
        $form = $this->createForm(new WritingType(), $entity, array(
            'action' => $this->generateUrl('writing_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Writing entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PromptBundle:Writing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Writing entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('writing_edit', array('id' => $id)));
        }

        return $this->render('PromptBundle:Writing:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Writing entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PromptBundle:Writing')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Writing entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('writing'));
    }

    /**
     * Creates a form to delete a Writing entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('writing_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
