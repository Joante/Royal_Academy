<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Pais;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pais controller.
 *
 * @Route("pais")
 */
class PaisController extends Controller
{
    /**
     * Lists all pais entities.
     *
     * @Route("/", name="pais_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pais = $em->getRepository('RoyalAcademyBundle:Pais')->findAll();

        return $this->render('pais/index.html.twig', array(
            'pais' => $pais,
        ));
    }

    /**
     * Creates a new pais entity.
     *
     * @Route("/new", name="pais_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pais = new Pais();
        $form = $this->createForm('RoyalAcademyBundle\Form\PaisType', $pais);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pais);
            $em->flush();

            return $this->redirectToRoute('pais_show', array('idpais' => $pais->getIdpais()));
        }

        return $this->render('pais/new.html.twig', array(
            'pais' => $pais,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pais entity.
     *
     * @Route("/{idpais}", name="pais_show")
     * @Method("GET")
     */
    public function showAction(Pais $pais)
    {
        $deleteForm = $this->createDeleteForm($pais);

        return $this->render('pais/show.html.twig', array(
            'pais' => $pais,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pais entity.
     *
     * @Route("/{idpais}/edit", name="pais_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pais $pais)
    {
        $deleteForm = $this->createDeleteForm($pais);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\PaisType', $pais);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pais_edit', array('idpais' => $pais->getIdpais()));
        }

        return $this->render('pais/edit.html.twig', array(
            'pais' => $pais,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pais entity.
     *
     * @Route("/{idpais}", name="pais_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pais $pais)
    {
        $form = $this->createDeleteForm($pais);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pais);
            $em->flush();
        }

        return $this->redirectToRoute('pais_index');
    }

    /**
     * Creates a form to delete a pais entity.
     *
     * @param Pais $pais The pais entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pais $pais)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pais_delete', array('idpais' => $pais->getIdpais())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
