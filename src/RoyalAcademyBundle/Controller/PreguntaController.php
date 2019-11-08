<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Pregunta;
use RoyalAcademyBundle\Entity\Respuesta;
use RoyalAcademyBundle\Entity\Materia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pregunta controller.
 *
 * @Route("pregunta")
 */
class PreguntaController extends Controller
{
    /**
     * Lists all pregunta entities.
     *
     * @Route("/", name="pregunta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $preguntas = $em->getRepository('RoyalAcademyBundle:Pregunta')->findAll();

        return $this->render('pregunta/index.html.twig', array(
            'preguntas' => $preguntas,
        ));
    }

    /**
     * Creates a new pregunta entity.
     *
     * @Route("/new", name="pregunta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pregunta = new Pregunta();
        $form = $this->createForm('RoyalAcademyBundle\Form\PreguntaType', $pregunta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pregunta->setExamenexamen(NULL);
            $em->persist($pregunta);
            $em->flush();

            return $this->redirectToRoute('pregunta_show', array('idpregunta' => $pregunta->getIdpregunta()));
        }

        return $this->render('pregunta/new.html.twig', array(
            'pregunta' => $pregunta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pregunta entity.
     *
     * @Route("/{idpregunta}", name="pregunta_show")
     * @Method("GET")
     */
    public function showAction(Pregunta $pregunta)
    {
        $deleteForm = $this->createDeleteForm($pregunta);

        return $this->render('pregunta/show.html.twig', array(
            'pregunta' => $pregunta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pregunta entity.
     *
     * @Route("/{idpregunta}/edit", name="pregunta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pregunta $pregunta)
    {
        $deleteForm = $this->createDeleteForm($pregunta);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\PreguntaType', $pregunta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pregunta_edit', array('idpregunta' => $pregunta->getIdpregunta()));
        }

        return $this->render('pregunta/edit.html.twig', array(
            'pregunta' => $pregunta,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pregunta entity.
     *
     * @Route("/{idpregunta}", name="pregunta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pregunta $pregunta)
    {
        $form = $this->createDeleteForm($pregunta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pregunta);
            $em->flush();
        }

        return $this->redirectToRoute('pregunta_index');
    }

    /**
     * Creates a form to delete a pregunta entity.
     *
     * @param Pregunta $pregunta The pregunta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pregunta $pregunta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pregunta_delete', array('idpregunta' => $pregunta->getIdpregunta())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
