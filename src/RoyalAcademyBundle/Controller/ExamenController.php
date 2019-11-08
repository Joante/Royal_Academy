<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Examen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * examen controller.
 *
 */
class ExamenController extends Controller
{
    /**
     * Lists all examen entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $examens = $em->getRepository('RoyalAcademyBundle:Examen')->findAll();

        return $this->render('examen/index.html.twig', array(
            'examens' => $examens,
        ));
    }

    /**
     * Creates a new examen entity.
     *
     */
    public function newAction(Request $request)
    {
        $examen = new examen();
        $form = $this->createForm('RoyalAcademyBundle\Form\ExamenType', $examen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($examen);
            $em->flush();

            return $this->redirectToRoute('examen_show', array('idexamen' => $examen->getIdexamen()));
        }

        return $this->render('examen/new.html.twig', array(
            'examen' => $examen,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a examen entity.
     *
     */
    public function showAction(Examen $examen)
    {
        $deleteForm = $this->createDeleteForm($examen);

        return $this->render('examen/show.html.twig', array(
            'examen' => $examen,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing examen entity.
     *
     */
    public function editAction(Request $request, Examen $examen)
    {
        $deleteForm = $this->createDeleteForm($examen);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\ExamenType', $examen);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('examen_edit', array('idexamen' => $examen->getIdexamen()));
        }

        return $this->render('examen/edit.html.twig', array(
            'examen' => $examen,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a examen entity.
     *
     */
    public function deleteAction(Request $request, Examen $examen)
    {
        $form = $this->createDeleteForm($examen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($examen);
            $em->flush();
        }

        return $this->redirectToRoute('examen_index');
    }

    /**
     * Creates a form to delete a examen entity.
     *
     * @param Examen $examen The examen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Examen $examen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('examen_delete', array('idexamen' => $examen->getIdexamen())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
