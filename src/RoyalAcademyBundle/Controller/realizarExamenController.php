<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\realizarExamen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Realizarexaman controller.
 *
 * @Route("realizarexamen")
 */
class realizarExamenController extends Controller
{
    /**
     * Lists all realizarExaman entities.
     *
     * @Route("/", name="realizarexamen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()
        ->getRepository('RoyalAcademyBundle:Examenrealizado');
    
    // createQueryBuilder() automatically selects FROM AppBundle:Product
    // and aliases it to "p"
    $query = $repository->createQueryBuilder('p')
        ->where('p.idexamenrealizado = :id')
        ->setParameter('id', 1)
        ->getQuery();
    
 $product = $query->setMaxResults(1)->getOneOrNullResult();




        /*
        $em = $this->getDoctrine()->getManager();

        $realizarExamens = $em->getRepository('RoyalAcademyBundle:Examenrealizado')->findAll();

        return $this->render('realizarexamen/index.html.twig', array(
            'realizarExamens' => $realizarExamens,
        ));*/
    }

    /**
     * Creates a new realizarExaman entity.
     *
     * @Route("/new", name="realizarexamen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $realizarExaman = new Realizarexaman();
        $form = $this->createForm('RoyalAcademyBundle\Form\realizarExamenType', $realizarExaman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($realizarExaman);
            $em->flush();

            return $this->redirectToRoute('realizarexamen_show', array('id' => $realizarExaman->getId()));
        }

        return $this->render('realizarexamen/new.html.twig', array(
            'realizarExaman' => $realizarExaman,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a realizarExaman entity.
     *
     * @Route("/{id}", name="realizarexamen_show")
     * @Method("GET")
     */
    public function showAction(realizarExamen $realizarExaman)
    {
        $deleteForm = $this->createDeleteForm($realizarExaman);

        return $this->render('realizarexamen/show.html.twig', array(
            'realizarExaman' => $realizarExaman,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing realizarExaman entity.
     *
     * @Route("/{id}/edit", name="realizarexamen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, realizarExamen $realizarExaman)
    {
        $deleteForm = $this->createDeleteForm($realizarExaman);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\realizarExamenType', $realizarExaman);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('realizarexamen_edit', array('id' => $realizarExaman->getId()));
        }

        return $this->render('realizarexamen/edit.html.twig', array(
            'realizarExaman' => $realizarExaman,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a realizarExaman entity.
     *
     * @Route("/{id}", name="realizarexamen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, realizarExamen $realizarExaman)
    {
        $form = $this->createDeleteForm($realizarExaman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($realizarExaman);
            $em->flush();
        }

        return $this->redirectToRoute('realizarexamen_index');
    }

    /**
     * Creates a form to delete a realizarExaman entity.
     *
     * @param realizarExamen $realizarExaman The realizarExaman entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(realizarExamen $realizarExaman)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('realizarexamen_delete', array('id' => $realizarExaman->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
