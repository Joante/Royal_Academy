<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Pregunta;
use RoyalAcademyBundle\Entity\Respuesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Preguntum controller.
 *
 * @Route("pregunta")
 */
class PreguntaController extends Controller
{
    /**
     * Lists all preguntum entities.
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
     * Creates a new preguntum entity.
     *
     * @Route("/new", name="pregunta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $preguntum = new Pregunta();
        $form = $this->createForm('RoyalAcademyBundle\Form\PreguntaType', $preguntum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($preguntum);
            $em->flush();

            return $this->redirectToRoute('pregunta_show', array('idpregunta' => $preguntum->getIdpregunta()));
        }

        return $this->render('pregunta/new.html.twig', array(
            'preguntum' => $preguntum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a preguntum entity.
     *
     * @Route("/{idpregunta}", name="pregunta_show")
     * @Method("GET")
     */
    public function showAction(Pregunta $preguntum)
    {
        $deleteForm = $this->createDeleteForm($preguntum);

        return $this->render('pregunta/show.html.twig', array(
            'preguntum' => $preguntum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing preguntum entity.
     *
     * @Route("/{idpregunta}/edit", name="pregunta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pregunta $preguntum)
    {
        $deleteForm = $this->createDeleteForm($preguntum);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\PreguntaType', $preguntum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pregunta_edit', array('idpregunta' => $preguntum->getIdpregunta()));
        }

        return $this->render('pregunta/edit.html.twig', array(
            'preguntum' => $preguntum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a preguntum entity.
     *
     * @Route("/{idpregunta}", name="pregunta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pregunta $preguntum)
    {
        $form = $this->createDeleteForm($preguntum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($preguntum);
            $em->flush();
        }

        return $this->redirectToRoute('pregunta_index');
    }

    /**
     * Creates a form to delete a preguntum entity.
     *
     * @param Pregunta $preguntum The preguntum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pregunta $preguntum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pregunta_delete', array('idpregunta' => $preguntum->getIdpregunta())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
