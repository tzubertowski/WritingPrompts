<?php

namespace PromptBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PromptBundle\Entity\Prompt;
use PromptBundle\Form\PromptType;

/**
 * Prompt controller.
 *
 */
class PromptController extends Controller
{

    /**
     * Lists all Prompt entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PromptBundle:Prompt')->findAll();

        return $this->render('PromptBundle:Prompt:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Prompt entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Prompt();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('prompt_show', array('id' => $entity->getId())));
        }

        return $this->render('PromptBundle:Prompt:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Prompt entity.
     *
     * @param Prompt $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Prompt $entity)
    {
        $form = $this->createForm(new PromptType(), $entity, array(
            'action' => $this->generateUrl('prompt_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Prompt entity.
     *
     */
    public function newAction()
    {
        $entity = new Prompt();
        $form   = $this->createCreateForm($entity);

        return $this->render('PromptBundle:Prompt:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Prompt entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PromptBundle:Prompt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Prompt entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PromptBundle:Prompt:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Prompt entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PromptBundle:Prompt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Prompt entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PromptBundle:Prompt:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Prompt entity.
    *
    * @param Prompt $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Prompt $entity)
    {
        $form = $this->createForm(new PromptType(), $entity, array(
            'action' => $this->generateUrl('prompt_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Prompt entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PromptBundle:Prompt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Prompt entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('prompt_edit', array('id' => $id)));
        }

        return $this->render('PromptBundle:Prompt:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Prompt entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PromptBundle:Prompt')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Prompt entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('prompt'));
    }

    /**
     * Creates a form to delete a Prompt entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prompt_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
