<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Respuesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Respuestum controller.
 *
 * @Route("respuesta")
 */
class RespuestaController extends Controller
{
    /**
     * Lists all respuestum entities.
     *
     * @Route("/", name="respuesta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $respuestas = $em->getRepository('RoyalAcademyBundle:Respuesta')->findAll();

        return $this->render('respuesta/index.html.twig', array(
            'respuestas' => $respuestas,
        ));
    }

    /**
     * Creates a new respuestum entity.
     *
     * @Route("/new", name="respuesta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $respuestum = new Respuestum();
        $form = $this->createForm('RoyalAcademyBundle\Form\RespuestaType', $respuestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($respuestum);
            $em->flush();

            return $this->redirectToRoute('respuesta_show', array('idrespuesta' => $respuestum->getIdrespuesta()));
        }

        return $this->render('respuesta/new.html.twig', array(
            'respuestum' => $respuestum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a respuestum entity.
     *
     * @Route("/{idrespuesta}", name="respuesta_show")
     * @Method("GET")
     */
    public function showAction(Respuesta $respuestum)
    {
        $deleteForm = $this->createDeleteForm($respuestum);

        return $this->render('respuesta/show.html.twig', array(
            'respuestum' => $respuestum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing respuestum entity.
     *
     * @Route("/{idrespuesta}/edit", name="respuesta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Respuesta $respuestum)
    {
        $deleteForm = $this->createDeleteForm($respuestum);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\RespuestaType', $respuestum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('respuesta_edit', array('idrespuesta' => $respuestum->getIdrespuesta()));
        }

        return $this->render('respuesta/edit.html.twig', array(
            'respuestum' => $respuestum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a respuestum entity.
     *
     * @Route("/{idrespuesta}", name="respuesta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Respuesta $respuestum)
    {
        $form = $this->createDeleteForm($respuestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($respuestum);
            $em->flush();
        }

        return $this->redirectToRoute('respuesta_index');
    }

    /**
     * Creates a form to delete a respuestum entity.
     *
     * @param Respuesta $respuestum The respuestum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Respuesta $respuestum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('respuesta_delete', array('idrespuesta' => $respuestum->getIdrespuesta())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
