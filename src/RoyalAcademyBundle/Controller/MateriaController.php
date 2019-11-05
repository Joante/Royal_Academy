<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Materia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * materia controller.
 *
 * @Route("materia")
 */
class MateriaController extends Controller
{
    /**
     * Lists all materia entities.
     *
     * @Route("/", name="materia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $materias = $em->getRepository('RoyalAcademyBundle:Materia')->findAll();

        return $this->render('materia/index.html.twig', array(
            'materias' => $materias,
        ));
    }

    /**
     * Creates a new materia entity.
     *
     * @Route("/new", name="materia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $materia = new Materia();
        $form = $this->createForm('RoyalAcademyBundle\Form\MateriaType', $materia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materia);
            $em->flush();

            return $this->redirectToRoute('materia_show', array('idmateria' => $materia->getIdmateria()));
        }

        return $this->render('materia/new.html.twig', array(
            'materia' => $materia,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a materia entity.
     *
     * @Route("/{idmateria}", name="materia_show")
     * @Method("GET")
     */
    public function showAction(Materia $materia)
    {
        $deleteForm = $this->createDeleteForm($materia);

        return $this->render('materia/show.html.twig', array(
            'materia' => $materia,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing materia entity.
     *
     * @Route("/{idmateria}/edit", name="materia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Materia $materia)
    {
        $deleteForm = $this->createDeleteForm($materia);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\MateriaType', $materia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materia_edit', array('idmateria' => $materia->getIdmateria()));
        }

        return $this->render('materia/edit.html.twig', array(
            'materia' => $materia,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a materia entity.
     *
     * @Route("/{idmateria}", name="materia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Materia $materia)
    {
        $form = $this->createDeleteForm($materia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($materia);
            $em->flush();
        }

        return $this->redirectToRoute('materia_index');
    }

    /**
     * Creates a form to delete a materia entity.
     *
     * @param Materia $materia The materia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Materia $materia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materia_delete', array('idmateria' => $materia->getIdmateria())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
