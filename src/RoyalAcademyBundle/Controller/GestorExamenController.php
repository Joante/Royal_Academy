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

        $pregDesordenadas= $lstPreguntas;
        shuffle($pregDesordenadas);

        for($i=0 ; $i<50; $i++)
        {  $pregAleatoria[$i] = $pregDesordenadas[$i]; }

        sort($pregAleatoria);

        return $this->render('gestorExamen/creadorAleatorio.html.twig', array(
            'lstPreguntas' => $lstPreguntas,
            'pregAleatoria' => $pregAleatoria
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
     * @Route("/examen", name="gestor_examen_examen")
     * @Method({"GET", "POST"})
     */
    public function examenManAction()
    {
        if (empty($_POST['chkPreguntas']))
        {
            return $this->redirect('http://localhost:8000/gestor_examen/error'.urlencode('?').'errCode=1');   
        }        
        else
        { 
            $preguntasSelec = $_POST['chkPreguntas'];
            $cant = count($preguntasSelec);

            if ($cant > 50)
            {return $this->redirect('http://localhost:8000/gestor_examen/error'.urlencode('?').'errCode=2');}

            
            foreach($preguntasSelec as $preg)
            {
                // Persistencia a la tabla Examen


                //Traigo las preguntas
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'select p from RoyalAcademyBundle:Pregunta p
                        where p.idpregunta = :pregId
                        order by p.idpregunta ASC')
                                    ->setParameter('pregId', (int)$preg);

                $lstPreguntas[(int)$preg] = $query->getResult();

                // Traigo la lista de respuestas
                $em = $this->getDoctrine()->getManager();

                $query = $em->createQuery(
                    'select r from RoyalAcademyBundle:Respuesta r
                        where r.preguntapregunta = :preguntapregunta
                        order by r.preguntapregunta ASC, r.idrespuesta ASC')->setParameter('preguntapregunta', (int)$preg);

                $lstRespuestas[(int)$preg] = $query->getResult();
            }

            // $lstPreguntas = array_slice($lstPreguntas, 0, 1);
        }
                
        return $this->render('gestorExamen/examen.html.twig', array(
            'lstPreguntas' => $lstPreguntas,
            'lstRespuestas' => $lstRespuestas
        ));

    }



    /**
     * 
     * @Route("/error?errCode={errCode}", name="gestor_examen_error")
     * @Method("GET")
     */
    public function errorAction()
    {
        $url = urldecode($_SERVER['REQUEST_URI']);
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        $errCode = $params['errCode'];

        if($errCode == 2){$errorMsg[1]= "No se selecciono ninguna pregunta";}

        if($errCode == 2){$errorMsg[1]= "Se seleccionaron demasiadas preguntas. Desmarque algunas para continuar (Limite 50)";}

        return $this->render('gestorExamen/error.html.twig',
            array('errorMsg' => $errorMsg));

    }
}