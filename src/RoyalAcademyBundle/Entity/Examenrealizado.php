<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examenrealizado
 *
 * @ORM\Table(name="examenrealizado", indexes={@ORM\Index(name="fk_ExamenRealizado_Alumno1_idx", columns={"Alumno_idAlumno"})})
 * @ORM\Entity
 */
class Examenrealizado
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="estaCompletado", type="boolean", nullable=true)
     */
    private $estacompletado;

    /**
     * @var integer
     *
     * @ORM\Column(name="nota", type="integer", nullable=true)
     */
    private $nota;

    /**
     * @var boolean
     *
     * @ORM\Column(name="informado", type="boolean", nullable=true)
     */
    private $informado;

    /**
     * @var integer
     *
     * @ORM\Column(name="turno", type="integer", nullable=true)
     */
    private $turno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="datetime", nullable=true)
     */
    private $fechainicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="idExamenRealizado", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexamenrealizado;

    /**
     * @var \RoyalAcademyBundle\Entity\Alumno
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Alumno_idAlumno", referencedColumnName="idAlumno")
     * })
     */
    private $alumnoalumno;
        
    /**
     * @var \RoyalAcademyBundle\Entity\Examen
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Examen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Examen_idExamen", referencedColumnName="idExamen")
     * })
     */
    private $examenexamen;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="RoyalAcademyBundle\Entity\Respuesta", mappedBy="examenrealizadoexamenrealizado", cascade="persist")
     * @ORM\JoinTable(name="examenrealizado_has_respuesta")
     */

    private $respuestarespuesta;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->respuestarespuesta = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set estacompletado
     *
     * @param boolean $estacompletado
     *
     * @return Examenrealizado
     */
    public function setEstacompletado($estacompletado)
    {
        $this->estacompletado = $estacompletado;

        return $this;
    }

    /**
     * Get estacompletado
     *
     * @return boolean
     */
    public function getEstacompletado()
    {
        return $this->estacompletado;
    }

    /**
     * Set nota
     *
     * @param integer $nota
     *
     * @return Examenrealizado
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return integer
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set informado
     *
     * @param boolean $informado
     *
     * @return Examenrealizado
     */
    public function setInformado($informado)
    {
        $this->informado = $informado;

        return $this;
    }

    /**
     * Get informado
     *
     * @return boolean
     */
    public function getInformado()
    {
        return $this->informado;
    }

    /**
     * Set turno
     *
     * @param integer $turno
     *
     * @return Examenrealizado
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno
     *
     * @return integer
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Examenrealizado
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     *
     * @return Examenrealizado
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return \DateTime
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Get idexamenrealizado
     *
     * @return integer
     */
    public function getIdexamenrealizado()
    {
        return $this->idexamenrealizado;
    }

    /**
     * Set alumnoalumno
     *
     * @param \RoyalAcademyBundle\Entity\Alumno $alumnoalumno
     *
     * @return Examenrealizado
     */
    public function setAlumnoalumno(\RoyalAcademyBundle\Entity\Alumno $alumnoalumno = null)
    {
        $this->alumnoalumno = $alumnoalumno;

        return $this;
    }

    /**
     * Get alumnoalumno
     *
     * @return \RoyalAcademyBundle\Entity\Alumno
     */
    public function getAlumnoalumno()
    {
        return $this->alumnoalumno;
    }

    /**
     * Add respuestarespuestum
     *
     * @param \RoyalAcademyBundle\Entity\Respuesta $respuestarespuestum
     *
     * @return Examenrealizado
     */
    public function addRespuestarespuestum(\RoyalAcademyBundle\Entity\Respuesta $respuestarespuestum)
    {
        $this->respuestarespuesta[] = $respuestarespuestum;

        return $this;
    }

    /**
     * Remove respuestarespuestum
     *
     * @param \RoyalAcademyBundle\Entity\Respuesta $respuestarespuestum
     */
    public function removeRespuestarespuestum(\RoyalAcademyBundle\Entity\Respuesta $respuestarespuestum)
    {
        $this->respuestarespuesta->removeElement($respuestarespuestum);
    }

    /**
     * Get respuestarespuesta
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRespuestarespuesta()
    {
        return $this->respuestarespuesta;
    }
    /**
     * Set examenexamen
     *
     * @param \RoyalAcademyBundle\Entity\Alumno $alumnoalumno
     *
     * @return Examenrealizado
     */
    public function setExamenexamen(\RoyalAcademyBundle\Entity\Examen $examenexamen = null)
    {
        $this->examenexamen = $examenexamen;

        return $this;
    }

    /**
     * Get examenexamen
     *
     * @return \RoyalAcademyBundle\Entity\Examen
     */
    public function getExamenexamen()
    {
        return $this->examenexamen;
    }
}
