<?php

namespace RoyalAcademyBundle\Controller;
use RoyalAcademyBundle\Entity\Alumno;
use RoyalAcademyBundle\Entity\Pregunta;
use RoyalAcademyBundle\Entity\Examenrealizado;
use RoyalAcademyBundle\Entity\Respuesta;
use RoyalAcademyBundle\Entity\Materia;
use RoyalAcademyBundle\Entity\Examen;
use Doctrine\ORM\EntityRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * CorregidorExamen controller.
 *
 * @Route("corrigiendo")
 */
class CorregidorExamenController extends Controller
{
    /**
     * Lists all CorregidorExamen entities.
     *
     * @Route("/{aprobados}", name="corrigiendo_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request, int $aprobados=0)
    {
       $form = $this->createForm('RoyalAcademyBundle\Form\CorrigiendoExamenType');  
       $minimoDeAprobacion=0;
        /*
        $query = $repository->createQueryBuilder('pregunta')
        ->where('examenrealizado.idexamenrealizado = :idExamenrealizado')
        ->leftJoin('pregunta.respuestas', 'rtas')
        ->leftJoin('rtas.examenrealizadoexamenrealizado', 'examenrealizado')
        ->setParameter('idExamenrealizado', $idexamenrealizado )
        ->orderBy('pregunta.idpregunta', 'desc')
        ->getQuery();
*/

        $repository = $this->getDoctrine()
        ->getRepository(Examen::class);
        $query = $repository->createQueryBuilder('examen') //HABRIA Q TRAER LA MATERIATAMBIEN
        ->leftJoin('examen.fechaexamenfechaexamen', 'fecha')
        ->orderBy('examen.idexamen', 'ASC')
        ->getQuery();
        $examenes = $query->getResult();
        
        $form->add("idExamenACorregir", EntityType::class, [
            "mapped" => false,            
            'class' => Examen::class,            
            'choices' => $examenes,
        ]);
                
        $form->add('Aprobarian:', IntegerType::class, [
            'attr' => ['class' => 'tinymce', 'scale' =>0, 'value' => $aprobados, 'empty_data'=> 0 ]
        ]);
        $form->add('ConsultarAprobados', SubmitType::class, ['label' => 'Calcular']);
        $form->add('EfectuarCorreccion', SubmitType::class, ['label' => 'Efectuar']);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            //CALCULO CUANTAS PERSONAS APROBARAN
            //traigo examen y veo cuantos alumnos cumplen la cant de respuestas
            //TRAIGO EXAMENES REALIZADOS
            $data = $form->getData(); //TRAIGOINFO DEFORMULARIO

            if ($request->isMethod('POST')) {

                if ($form->get('EfectuarCorreccion')->isClicked()){
                    die(); //REDIRECCIONO A PAGINA Q DA OK DE CORRCCION
                }

                $aprobados=0;                             
                $minimoDeAprobacion = $form->get('cantidadDeRespuestasNecesariasParaAprobar')->getData();
                
                $em = $this->getDoctrine()->getManager();
                $examenesRealizados = $em->getRepository('RoyalAcademyBundle:Examenrealizado')->findAll();

                $examen = $form->get('idExamenACorregir')->getData();

                foreach ($examenesRealizados as $examenRealizado){
                    print_r(("OTROEXMEN"));
                    print_r($examen->getIdexamen());
                    print_r($examenRealizado->getIdexamenrealizado());
                    $repository2 = $this->getDoctrine()
                        ->getRepository(Pregunta::class);
                    
                    $query2 = $repository2->createQueryBuilder('pregunta')
                    ->where('examenrealizado.idexamenrealizado = :idexamenrealizado and rtas.escorrecta = 1 and examen.idexamen = :idExamen')
                    ->leftJoin('pregunta.respuestas', 'rtas')
                    ->leftJoin('rtas.examenrealizadoexamenrealizado', 'examenrealizado')
                    ->leftJoin('pregunta.examenexamen', 'examen')                    
                    ->setParameter('idexamenrealizado', $examenRealizado->getIdexamenrealizado())
                    ->setParameter('idExamen', $examen->getIdexamen())
                    ->getQuery();
                    
                    $cantidadCorrectasEnExamenRealizado = count($query2->getResult());   
                    print_r("correctas: ". $cantidadCorrectasEnExamenRealizado. "\n");
                    print_r("cantidad para aprobar". $minimoDeAprobacion);
                    if($cantidadCorrectasEnExamenRealizado == NULL){
                        print_r("NULO");
                    }
                    else{
                        if($cantidadCorrectasEnExamenRealizado >= $minimoDeAprobacion)
                            $aprobados = $aprobados+1;
                    }
        
                }
                print_r("--> CANTIDAD DE APROBADOS: ". $aprobados);
                return $this->redirectToRoute('corrigiendo_index', 
                array('aprobados' => $aprobados,  'form' => $form->createView()));
            }

        }

        return $this->render('corrigiendo/index.html.twig', array(
            'aprobados' => $aprobados, 'notaMinima' => $minimoDeAprobacion,
            'idExamenACorregir'=> $form->get('idExamenACorregir')->getData(), 'form' => $form->createView()
        ));

    }

        /**
     * Lists all CorregidorExamen entities.
     *
     * @Route("/{notaMinima}{idExamenACorregir}/corregir", name="corrigiendo_corregir")
     * @Method({"GET", "POST"})
     */
    public function corregirAction(Request $request, int $notaMinima, int $idExamenACorregir)
    {

    }

}
