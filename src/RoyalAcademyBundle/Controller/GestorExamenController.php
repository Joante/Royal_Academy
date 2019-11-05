<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Examen;
use RoyalAcademyBundle\Entity\Materia;
use RoyalAcademyBundle\Entity\Pregunta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * GestorExamen controller.
 *
 * @Route("gestor_examen")
 */
class GestorExamenController extends Controller
{
    /**
     * Lists all GestorExamen entities.
     *
     * @Route("/", name="gestor_examen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('gestorExamen/index.html.twig');
    }

    /**
     * Genera un examen aleatorio por materia
     *
     * @Route("/aleatorio", name="gestor_examen_random")
     * @Method("GET")
     */
    public function generarAleatorio($idMateria)
    {
        $em = $this->getDoctrine()->getManager();

        $preguntas = $em->getRepository('RoyalAcademyBundle:Pregunta::Materia_idMateria')->findby($idMateria);

        return $this->render('gestorExamen/index.html.twig', array(
            'preguntas' => $preguntas,
        ));
    }

}