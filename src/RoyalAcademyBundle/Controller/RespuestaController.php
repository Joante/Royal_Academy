<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Respuesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Respuesta controller.
 *
 * @Route("respuesta")
 */
class RespuestaController extends Controller
{
    /**
     * Lists all respuesta entities.
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
     * Creates a new respuesta entity.
     *
     * @Route("/new", name="respuesta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $respuesta = new Respuesta();
        $form = $this->createForm('RoyalAcademyBundle\Form\RespuestaType', $respuesta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($respuesta);
            $em->flush();

            return $this->redirectToRoute('respuesta_show', array('idrespuesta' => $respuesta->getIdrespuesta()));
        }

        return $this->render('respuesta/new.html.twig', array(
            'respuesta' => $respuesta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new respuesta entity.
     *
     * @Route("/new/{idPregunta}", name="respuesta_new2")
     * @Method({"GET", "POST"})
     */
    public function newActionId(Request $request, Int $idpregunta)
    {
        $respuesta = new Respuesta();
        $form = $this->createForm('RoyalAcademyBundle\Form\RespuestaType', $respuesta);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Pregunta::class);
        $pregunta = $repository->FindOneById($idpregunta);

        if ($form->isSubmitted() && $form->isValid()) {
            $respuesta->setPreguntapregunta($pregunta);
            $em->persist($respuesta);
            $em->flush();

            return $this->redirectToRoute('respuesta_show', array('idrespuesta' => $respuesta->getIdrespuesta()));
        }

        return $this->render('respuesta/new.html.twig', array(
            'respuesta' => $respuesta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a respuesta entity.
     *
     * @Route("/{idrespuesta}", name="respuesta_show")
     * @Method("GET")
     */
    public function showAction(Respuesta $respuesta)
    {
        $deleteForm = $this->createDeleteForm($respuesta);

        return $this->render('respuesta/show.html.twig', array(
            'respuesta' => $respuesta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing respuesta entity.
     *
     * @Route("/{idrespuesta}/edit", name="respuesta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Respuesta $respuesta)
    {
        $deleteForm = $this->createDeleteForm($respuesta);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\RespuestaType', $respuesta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('respuesta_edit', array('idrespuesta' => $respuesta->getIdrespuesta()));
        }

        return $this->render('respuesta/edit.html.twig', array(
            'respuesta' => $respuesta,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a respuesta entity.
     *
     * @Route("/{idrespuesta}", name="respuesta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Respuesta $respuesta)
    {
        $form = $this->createDeleteForm($respuesta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($respuesta);
            $em->flush();
        }

        return $this->redirectToRoute('respuesta_index');
    }

    /**
     * Creates a form to delete a respuesta entity.
     *
     * @param Respuesta $respuesta The respuesta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Respuesta $respuesta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('respuesta_delete', array('idrespuesta' => $respuesta->getIdrespuesta())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
