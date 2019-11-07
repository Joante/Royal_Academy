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
        $em = $this->getDoctrine()->getManager();

        $lstMaterias = $em->getRepository('RoyalAcademyBundle:Materia')->findAll();


        return $this->render('gestorExamen/index.html.twig', 
            array('lstMaterias' => $lstMaterias));
    }

    /**
     * Genera un examen aleatorio por materia
     *
     * @Route("/automatico?idMateria={idMateria}", name="gestor_examen_automatico")
     * @Method("GET")
     */
    public function creadorAutomaticoAction()
    {
        $url = urldecode($_SERVER['REQUEST_URI']);
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        $idMateria = $params['idMateria'];

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'select p from RoyalAcademyBundle:Pregunta p
                where p.idMateria = :idMateria
                order by p.idpregunta ASC')->setParameter('idMateria', $idMateria);

        $lstPreguntas = $query->getResult();

        return $this->render('gestorExamen/creadorAleatorio.html.twig', array(
            'preguntas' => $preguntas
        ));
    }


    /**
     * Genera trae la lista de preguntas por materia
     * @Route("/manual?idMateria={idMateria}", name="gestor_examen_manual")
     * @Method("GET")
     */
    public function creadorManualAction()
    {        
        $url = urldecode($_SERVER['REQUEST_URI']);
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        $idMateria = $params['idMateria'];

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'select p from RoyalAcademyBundle:Pregunta p
                where p.idMateria = :idMateria
                order by p.idpregunta ASC')->setParameter('idMateria', $idMateria);

        $lstPreguntas = $query->getResult();

        return $this->render('gestorExamen/creadorManual.html.twig', array(
            'lstPreguntas' => $lstPreguntas
        ));
    }


    /**
     * 
     * @Route("/selector", name="gestor_examen_selector")
     * @Method("GET")
     */
    public function selectorAction()
    {

        if (isset($_POST['radMateria'], $_POST['radGestor']))
        { 
            $idMateria = $_POST['radMateria'];
            $idGestor = $_POST['radGestor'];
        }
                
        if($idGestor == "manual")
        { $ruta = 'http://localhost:8000/gestor_examen/manual'.urlencode('?').'idMateria='.$idMateria;
            return $this->redirect($ruta);}
        
        if($idGestor == "automatico")
        {$ruta = 'http://localhost:8000/gestor_examen/automatico'.urlencode('?').'idMateria='.$idMateria;
            return $this->redirect($ruta);}

    }
}