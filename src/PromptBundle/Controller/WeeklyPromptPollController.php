<?php

namespace PromptBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PromptBundle\Entity\WeeklyPromptPoll;
use PromptBundle\Form\WeeklyPromptPollType;

/**
 * WeeklyPromptPoll controller.
 *
 */
class WeeklyPromptPollController extends Controller
{

    /**
     * Lists all WeeklyPromptPoll entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PromptBundle:WeeklyPromptPoll')->findAll();

        return $this->render('PromptBundle:WeeklyPromptPoll:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new WeeklyPromptPoll entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new WeeklyPromptPoll();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('weeklypromptpoll_show', array('id' => $entity->getId())));
        }

        return $this->render('PromptBundle:WeeklyPromptPoll:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a WeeklyPromptPoll entity.
     *
     * @param WeeklyPromptPoll $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(WeeklyPromptPoll $entity)
    {
        $form = $this->createForm(new WeeklyPromptPollType(), $entity, array(
            'action' => $this->generateUrl('weeklypromptpoll_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new WeeklyPromptPoll entity.
     *
     */
    public function newAction()
    {
        $entity = new WeeklyPromptPoll();
        $form   = $this->createCreateForm($entity);

        return $this->render('PromptBundle:WeeklyPromptPoll:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a WeeklyPromptPoll entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PromptBundle:WeeklyPromptPoll')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WeeklyPromptPoll entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PromptBundle:WeeklyPromptPoll:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing WeeklyPromptPoll entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PromptBundle:WeeklyPromptPoll')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WeeklyPromptPoll entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PromptBundle:WeeklyPromptPoll:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a WeeklyPromptPoll entity.
    *
    * @param WeeklyPromptPoll $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(WeeklyPromptPoll $entity)
    {
        $form = $this->createForm(new WeeklyPromptPollType(), $entity, array(
            'action' => $this->generateUrl('weeklypromptpoll_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing WeeklyPromptPoll entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PromptBundle:WeeklyPromptPoll')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WeeklyPromptPoll entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('weeklypromptpoll_edit', array('id' => $id)));
        }

        return $this->render('PromptBundle:WeeklyPromptPoll:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a WeeklyPromptPoll entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PromptBundle:WeeklyPromptPoll')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find WeeklyPromptPoll entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('weeklypromptpoll'));
    }

    /**
     * Creates a form to delete a WeeklyPromptPoll entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('weeklypromptpoll_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
