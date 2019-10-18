<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Sede;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sede controller.
 *
 * @Route("sede")
 */
class SedeController extends Controller
{
    /**
     * Lists all sede entities.
     *
     * @Route("/", name="sede_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sedes = $em->getRepository('RoyalAcademyBundle:Sede')->findAll();

        return $this->render('sede/index.html.twig', array(
            'sedes' => $sedes,
        ));
    }

    /**
     * Creates a new sede entity.
     *
     * @Route("/new", name="sede_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sede = new Sede();
        $form = $this->createForm('RoyalAcademyBundle\Form\SedeType', $sede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sede);
            $em->flush();

            return $this->redirectToRoute('sede_show', array('idsede' => $sede->getIdsede()));
        }

        return $this->render('sede/new.html.twig', array(
            'sede' => $sede,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sede entity.
     *
     * @Route("/{idsede}", name="sede_show")
     * @Method("GET")
     */
    public function showAction(Sede $sede)
    {
        $deleteForm = $this->createDeleteForm($sede);

        return $this->render('sede/show.html.twig', array(
            'sede' => $sede,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sede entity.
     *
     * @Route("/{idsede}/edit", name="sede_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sede $sede)
    {
        $deleteForm = $this->createDeleteForm($sede);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\SedeType', $sede);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sede_edit', array('idsede' => $sede->getIdsede()));
        }

        return $this->render('sede/edit.html.twig', array(
            'sede' => $sede,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sede entity.
     *
     * @Route("/{idsede}", name="sede_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sede $sede)
    {
        $form = $this->createDeleteForm($sede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sede);
            $em->flush();
        }

        return $this->redirectToRoute('sede_index');
    }

    /**
     * Creates a form to delete a sede entity.
     *
     * @param Sede $sede The sede entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sede $sede)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sede_delete', array('idsede' => $sede->getIdsede())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
