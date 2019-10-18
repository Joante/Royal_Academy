<?php

namespace RoyalAcademyBundle\Controller;
use RoyalAcademyBundle\Entity\Administrador;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Administrador controller.
 *
 * @Route("admin")
 */
class AdministradorController extends Controller
{
    /**
     * Lists all administrador entities.
     *
     * @Route("/", name="admin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $administradors = $em->getRepository('RoyalAcademyBundle:Administrador')->findAll();

        return $this->render('administrador/index.html.twig', array(
            'administradors' => $administradors,
        ));
    }

    /**
     * Creates a new administrador entity.
     *
     * @Route("/new", name="admin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $administrador = new Administrador();
        $form = $this->createForm('RoyalAcademyBundle\Form\AdministradorType', $administrador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($administrador);
            $em->flush();

            return $this->redirectToRoute('admin_show', array('idadministrador' => $administrador->getIdadministrador()));
        }

        return $this->render('administrador/new.html.twig', array(
            'administrador' => $administrador,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a administrador entity.
     *
     * @Route("/{idadministrador}", name="admin_show")
     * @Method("GET")
     */
    public function showAction(Administrador $administrador)
    {
        $deleteForm = $this->createDeleteForm($administrador);

        return $this->render('administrador/show.html.twig', array(
            'administrador' => $administrador,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing administrador entity.
     *
     * @Route("/{idadministrador}/edit", name="admin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Administrador $administrador)
    {
        $deleteForm = $this->createDeleteForm($administrador);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\AdministradorType', $administrador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_edit', array('idadministrador' => $administrador->getIdadministrador()));
        }

        return $this->render('administrador/edit.html.twig', array(
            'administrador' => $administrador,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a administrador entity.
     *
     * @Route("/{idadministrador}", name="admin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Administrador $administrador)
    {
        $form = $this->createDeleteForm($administrador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($administrador);
            $em->flush();
        }

        return $this->redirectToRoute('admin_index');
    }

    /**
     * Creates a form to delete a administrador entity.
     *
     * @param Administrador $administrador The administrador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Administrador $administrador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_delete', array('idadministrador' => $administrador->getIdadministrador())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
