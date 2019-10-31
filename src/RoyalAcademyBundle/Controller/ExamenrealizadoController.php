<?php

namespace RoyalAcademyBundle\Controller;
use RoyalAcademyBundle\Entity\Alumno;
use RoyalAcademyBundle\Entity\Pregunta;
use RoyalAcademyBundle\Entity\Examenrealizado;
use RoyalAcademyBundle\Entity\Respuesta;
use Doctrine\ORM\EntityRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Examenrealizado controller.
 *
 * @Route("examenrealizado")
 */
class ExamenrealizadoController extends Controller
{
    /**
     * Lists all examenrealizado entities.
     *
     * @Route("/{idalumno}", name="examenrealizado_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request, int $idalumno)
    {
        
        $em = $this->getDoctrine()->getManager();

       // $examenrealizados = $em->getRepository('RoyalAcademyBundle:Examenrealizado')->findAll();


       $repository = $this->getDoctrine()
       ->getRepository(Examenrealizado::class);
   
   // createQueryBuilder() automatically selects FROM AppBundle:Product
   // and aliases it to "p"
        $query = $repository->createQueryBuilder('p')
        ->where('p.alumnoalumno = :id and p.estacompletado = 0')
        ->setParameter('id', $idalumno)
        ->leftjoin('p.alumnoalumno','Alumno')
        ->orderBy('p.idexamenrealizado', 'ASC')
        ->getQuery();
    
       $examenrealizados = $query->getResult();
       
       $repositoryAlumno = $this->getDoctrine()
       ->getRepository(Alumno::class);
       $alumno = $this->getDoctrine()->getRepository(Alumno::class)->find($idalumno);

        return $this->render('examenrealizado/index.html.twig', array(
            'examenrealizados' => $examenrealizados, 'alumno' => $alumno,
        ));
    }

    /**
     * Creates a new examenrealizado entity.
     *
     * @Route("/new", name="examenrealizado_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $examenrealizado = new Examenrealizado();
        $form = $this->createForm('RoyalAcademyBundle\Form\ExamenrealizadoType', $examenrealizado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($examenrealizado);
            $em->flush();

            return $this->redirectToRoute('examenrealizado_show', array('idexamenrealizado' => $examenrealizado->getIdexamenrealizado()));
        }

        return $this->render('examenrealizado/new.html.twig', array(
            'examenrealizado' => $examenrealizado,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a examenrealizado entity.
     *
     * @Route("/{idexamenrealizado}", name="examenrealizado_show")
     * @Method("GET")
     */
    public function showAction(Examenrealizado $examenrealizado)
    {
        $deleteForm = $this->createDeleteForm($examenrealizado);

        return $this->render('examenrealizado/show.html.twig', array(
            'examenrealizado' => $examenrealizado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing examenrealizado entity.
     *
     * @Route("/{idexamenrealizado}{alumno}/edit", name="examenrealizado_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Examenrealizado $examenrealizado, int $alumno)
    {
        $deleteForm = $this->createDeleteForm($examenrealizado);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\ExamenrealizadoType', $examenrealizado);
        $editForm->handleRequest($request);
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

        }

       $repositoryAlumno = $this->getDoctrine()->getRepository(Alumno::class);
       $alumno = $this->getDoctrine()->getRepository(Alumno::class)->find($alumno);

        return $this->render('examenrealizado/edit.html.twig', array(
            'examenrealizado' => $examenrealizado,'alumno' => $alumno,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a examenrealizado entity.
     *
     * @Route("/{idexamenrealizado}", name="examenrealizado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Examenrealizado $examenrealizado)
    {
        $form = $this->createDeleteForm($examenrealizado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($examenrealizado);
            $em->flush();
        }

        return $this->redirectToRoute('examenrealizado_index');
    }

    /**
     * Creates a form to delete a examenrealizado entity.
     *
     * @param Examenrealizado $examenrealizado The examenrealizado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Examenrealizado $examenrealizado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('examenrealizado_delete', array('idexamenrealizado' => $examenrealizado->getIdexamenrealizado())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

//REALIZACION DEEXaMen
/**
     * Displays a form to edit an existing examenrealizado entity.
     *
     * @Route("/{idexamenrealizado}{idalumno}/realizando", name="examenrealizado_realizando")
     * @Method({"GET", "POST"})
     */
    public function realizandoAction(Request $request, int $idexamenrealizado, int $idalumno)
    {
        
       // print_r($ultimaPreguntaContestada);
        //-------------------------- EN ESTE PUNTOTENGO EL ID de la ultima pregunta contestada
        //-------------------------- CARGO 5 preguntas a partir de ese ID
        $examenrealizado = new Examenrealizado();
        $form = $this->createForm('RoyalAcademyBundle\Form\ExamenrealizadoType', $examenrealizado);  
        
        $repositoryExamenRealizado = $this->getDoctrine()
        ->getRepository(Examenrealizado::class);
        $examenrealizado = $this->getDoctrine()->getRepository(Examenrealizado::class)->find($idexamenrealizado);

        //print_r("EXAMEN REALIZADO: ". $idexamenrealizado);
        //print_r("EXAMEN: ". $examenrealizado->getExamenexamen()->getIdExamen());
        $ultimaPreguntaContestada = $this->consultarUltimaPreguntaDeExamen($idexamenrealizado,$examenrealizado->getExamenexamen()->getIdExamen());
        //print_r("ULTIMA PREGUNTA DE EXAMEN: ". $ultimaPreguntaContestada);
        //die();
        $repositoryAlumno = $this->getDoctrine()
        ->getRepository(Alumno::class);
        $alumno = $this->getDoctrine()->getRepository(Alumno::class)->find($idalumno);

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
        ->getRepository(Pregunta::class);

        $repositoryRta = $this->getDoctrine()
        ->getRepository(Respuesta::class);
        
        //print_r("no llego a ejecutar");
         //OJOOOO EXAMENEXAMEN NO ES ELEXAMEN RELIZADO SINO ELEXMENEN CURSO -> CORREGIDO
        $query = $repository->createQueryBuilder('pregunta')
        ->where('pregunta.examenexamen = :id and pregunta.idpregunta > :idUltimaPregunta')
        ->setParameter('id', $examenrealizado->getexamenexamen()) //->setParameter('id', $idexamenrealizado) 
        ->setParameter('idUltimaPregunta', $ultimaPreguntaContestada) 
        ->orderBy('pregunta.idpregunta', 'ASC')
        ->setMaxResults(3) //MAX_PREGUNTAS_POR_PAGINA =3
        ->getQuery();
        $preguntasDeExamen = $query->getResult();
        //print_r(" llego a ejecutar");

        if(!$preguntasDeExamen or !$query){
            //SI NO TRAE MAS PREGUNTAS TERMINO EXAMEN
            $examenrealizado->setEstacompletado(1); // SI COMPLETO      
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($examenrealizado);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('examenrealizado_index',
                                        array('idalumno' => $idalumno )));
            //die("fin de examen, todas las preguntas han sido contestadas");
        }
        else{
            // Agregar dinámicamente las respuestas a cada pregunta
            foreach ($preguntasDeExamen as $pregunta){
                // Traigo respuestas
            // print_r("Traigo respuestas");
                $queryRta = $repositoryRta->createQueryBuilder('respuesta')
                ->where('respuesta.preguntapregunta = :id')
                ->setParameter('id', $pregunta->getIdpregunta()) 
                ->orderBy('respuesta.preguntapregunta', 'ASC')
                ->getQuery();
                $rtaDeExamen = $queryRta->getResult();

                //print_r($rtaDeExamen);
                if(!$queryRta){
                    die("Query Failed" );
                }
    /*
                $form->add($pregunta->getIdpregunta(), ChoiceType::class, array(
                    "label" => $pregunta->getDescripcion(),
                    "mapped" => false,
                    "trim" => true,
                    "multiple" => true,
                    "attr" => array(
                        'class' => "form-control"
                    ),
                    'choices' => array(
                        $rtaDeExamen[0]->getDescripcion() => $rtaDeExamen[0]->getIdrespuesta(), //TENGO LA DESCR Y EL ID COMO DATO
                        $rtaDeExamen[1]->getDescripcion() => $rtaDeExamen[1]->getIdrespuesta(),
                    ),

                ));
    */          
                $form->add($pregunta->getIdpregunta(), EntityType::class, [
                    "mapped" => false,
                    "label" => $pregunta->getDescripcion(),
                    'class' => Respuesta::class,
                    'choices' => $rtaDeExamen,
                ]);
            }

            $form->handleRequest($request);
            
            if ($form->isSubmitted() and $form->isValid()) {
                //GUARDO RESPUESTAS 
                //print_r("SUBMIT PAGINA");      
                if ($request->isMethod('POST')) {
                    $repositoryExamenRealizado = $this->getDoctrine()
                    ->getRepository(Examenrealizado::class);
                    $examenrealizado = $this->getDoctrine()->getRepository(Examenrealizado::class)->find($idexamenrealizado);            
                    
                    /*$query = $repository->createQueryBuilder('pregunta')
                    ->where('pregunta.examenexamen = :id')
                    ->setParameter('id', $idexamenrealizado) 
                    ->orderBy('pregunta.idpregunta', 'ASC')
                    ->getQuery();
                    $preguntasDeExamen = $query->getResult();                 
                    */
                    
                    $respuestaElegidas = new ArrayCollection();
                    
                    foreach ($preguntasDeExamen as $pregunta){
                        $respuestaElegidas->add($form->get($pregunta->getIdpregunta())->getData());                                    
                    }
                    
                    $data = $form->getData();
                    
                    /*//AGREGO LAS RTA AL EXAMEN 
                    foreach ($rtaDeExamen as $res){                
                        $examenrealizado->addRespuestarespuestum($res); //AGREGO A EXAMEN LAS RTAS
                    // print_r($res->getDescripcion());
                    }*/
                    // PERSISTO            
                    $entityManager = $this->getDoctrine()->getManager();
                    //$examenrealizado->setEstacompletado(1); SI COMPLETO
                    $entityManager->persist($examenrealizado);
                    $entityManager->flush();
                        
                    $this->insertarRespuestasDeExamenRealizado($examenrealizado->getIdexamenrealizado(), $respuestaElegidas);
                    //RECARGO PAGINA --> CARGARA PROXIMAS RESPUESTAS
                
                    return $this->redirect($this->generateUrl('examenrealizado_realizando',
                                        array('idexamenrealizado' => $idexamenrealizado, 
                                        'idalumno' => $idalumno )));
                }
            }
        }
        return $this->render('examenrealizado/realizando.html.twig', array(
            'examenrealizado' => $examenrealizado, 'alumno' => $alumno, 'preguntas' => $preguntasDeExamen,
            /*'respuestas' => $rtaDeExamen, */'form' => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing examenrealizado entity.
     *
     * @Route("/{idexamenrealizado}{idalumno}/guardandoParcial", name="examenrealizado_guardarResultadoParcial")
     * @Method({"GET", "POST"})
     */
    public function guardarResultadoParcialAction(Request $request, int $idexamenrealizado, int $idalumno)
    {   
        //print_r("guardando");
        $p1 = $_POST["consulta"];
        die();
        return $this->render('examenrealizado/realizando.html.twig', array(
            'examenrealizado' => $examenrealizado, 'alumno' => $alumno, 'preguntas' => $preguntasDeExamen,
            'respuestas' => $rtaDeExamen,
        ));
    }

    public function insertarRespuestasDeExamenRealizado(int $idexamenrealizado, ArrayCollection $respuestas){
        $entityManager = $this->getDoctrine()->getEntityManager();
    
        foreach ($respuestas as $respuesta){            
            try{
                $query = $entityManager->createNativeQuery("CALL sp_guardar_respuestas_realizadas(" .":rta,:idExamenResuelto" .")",            
                new ResultSetMapping());
                $query->setParameters(
                    array(
                    "idExamenResuelto" => $idexamenrealizado,
                    "rta" => $respuesta,
                    ));
                $query->execute();
                $entityManager->flush();
                die();
            }
            catch(\Exception $e){
                $errorMessage = $e->getMessage();
            }
        }
    }

    public function consultarUltimaPreguntaDeExamen(int $idexamenrealizado, int $idexamen):?int{
        /*SELECT MAX(idPregunta) into _ultima FROM `royal_academy`.pregunta 
        inner join respuesta on pregunta.idPregunta=respuesta.Pregunta_idPregunta
        inner join examenrealizado_has_respuesta on respuesta.idrespuesta = examenrealizado_has_respuesta.respuesta_idrespuesta
        where examenrealizado_has_respuesta.ExamenRealizado_idExamenRealizado=1
        order by pregunta.idPregunta;*/
        $preguntaMaxima=0;
        try{
            $repository= $this->getDoctrine()
            ->getRepository(Pregunta::class);

            $query = $repository->createQueryBuilder('pregunta')
            ->where('examenrealizado.examenexamen = :idexamen and examenrealizado.idexamenrealizado= :idexamenrealizado')
            ->leftJoin('pregunta.respuestas', 'rtas')
            ->leftJoin('rtas.examenrealizadoexamenrealizado', 'examenrealizado')
            ->setParameter('idexamen', $idexamen )
            ->setParameter('idexamenrealizado', $idexamenrealizado )
            ->orderBy('pregunta.idpregunta', 'desc')
            ->getQuery();
            $preguntasContestadas = $query->getResult();   
            if($preguntasContestadas != NULL){
                $preguntaMaxima = $preguntasContestadas[0]->getIdpregunta();
            }
        }
        catch(\Exception $e){
            $errorMessage = $e->getMessage();
            print_r($e->getMessage());
        }

        return $preguntaMaxima;
        
    }

    /*
    public function consultarUltimaPreguntaDeExamen(int $idexamenrealizado):?int{
        $entityManager = $this->getDoctrine()->getEntityManager();
        try{
            //CALL `royal_academy`.`sp_get_ultima_pregunta_examen_realizado`(1,@ultima);
            //$ultimaPregunta = 1;
            $query = $entityManager->createNativeQuery("CALL sp_get_ultima_pregunta_examen_realizado(" .":idExamenResuelto, @ultima" .")",            
            new ResultSetMapping());
            $query->setParameters(
                array(
                "idExamenResuelto" => $idexamenrealizado,
                "ultima" => $ultimaPregunta,
                ));
            $query->execute();
            $entityManager->flush();        
            $ultima = $query->getResult();
        }
        catch(\Exception $e){
            $errorMessage = $e->getMessage();
        }
        
        return $ultimaPregunta;
    }
    */
}
