<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fechaexamen
 *
 * @ORM\Table(name="fechaexamen", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_4F874DD2B8365375", columns={"Materia_idMateria"}), @ORM\UniqueConstraint(name="UNIQ_4F874DD219A83F38", columns={"Sede_idSede"})}, indexes={@ORM\Index(name="fk_FechaExamen_Sede1_idx", columns={"Sede_idSede"}), @ORM\Index(name="fk_FechaExamen_Materia1_idx", columns={"Materia_idMateria"})})
 * @ORM\Entity
 */
class Fechaexamen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CantMax", type="integer", nullable=false)
     */
    private $cantmax;

    /**
     * @var integer
     *
     * @ORM\Column(name="CantActual", type="integer", nullable=false)
     */
    private $cantactual;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="idFechaExamen", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfechaexamen;

    /**
     * @var \RoyalAcademyBundle\Entity\Sede
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Sede")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Sede_idSede", referencedColumnName="idSede")
     * })
     */
    private $sedesede;

    /**
     * @var \RoyalAcademyBundle\Entity\Materia
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Materia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Materia_idMateria", referencedColumnName="idMateria")
     * })
     */
    private $materiamateria;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="RoyalAcademyBundle\Entity\Alumno", mappedBy="fechaexamenfechaexamen")
     */
    private $alumnoalumno;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alumnoalumno = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set cantmax
     *
     * @param integer $cantmax
     *
     * @return Fechaexamen
     */
    public function setCantmax($cantmax)
    {
        $this->cantmax = $cantmax;

        return $this;
    }

    /**
     * Get cantmax
     *
     * @return integer
     */
    public function getCantmax()
    {
        return $this->cantmax;
    }

    /**
     * Set cantactual
     *
     * @param integer $cantactual
     *
     * @return Fechaexamen
     */
    public function setCantactual($cantactual)
    {
        $this->cantactual = $cantactual;

        return $this;
    }

    /**
     * Get cantactual
     *
     * @return integer
     */
    public function getCantactual()
    {
        return $this->cantactual;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Fechaexamen
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
     * Get idfechaexamen
     *
     * @return integer
     */
    public function getIdfechaexamen()
    {
        return $this->idfechaexamen;
    }

    /**
     * Set sedesede
     *
     * @param \RoyalAcademyBundle\Entity\Sede $sedesede
     *
     * @return Fechaexamen
     */
    public function setSedesede(\RoyalAcademyBundle\Entity\Sede $sedesede = null)
    {
        $this->sedesede = $sedesede;

        return $this;
    }

    /**
     * Get sedesede
     *
     * @return \RoyalAcademyBundle\Entity\Sede
     */
    public function getSedesede()
    {
        return $this->sedesede;
    }

    /**
     * Set materiamateria
     *
     * @param \RoyalAcademyBundle\Entity\Materia $materiamateria
     *
     * @return Fechaexamen
     */
    public function setMateriamateria(\RoyalAcademyBundle\Entity\Materia $materiamateria = null)
    {
        $this->materiamateria = $materiamateria;

        return $this;
    }

    /**
     * Get materiamateria
     *
     * @return \RoyalAcademyBundle\Entity\Materia
     */
    public function getMateriamateria()
    {
        return $this->materiamateria;
    }

    /**
     * Add alumnoalumno
     *
     * @param \RoyalAcademyBundle\Entity\Alumno $alumnoalumno
     *
     * @return Fechaexamen
     */
    public function addAlumnoalumno(\RoyalAcademyBundle\Entity\Alumno $alumnoalumno)
    {
        $this->alumnoalumno[] = $alumnoalumno;

        return $this;
    }

    /**
     * Remove alumnoalumno
     *
     * @param \RoyalAcademyBundle\Entity\Alumno $alumnoalumno
     */
    public function removeAlumnoalumno(\RoyalAcademyBundle\Entity\Alumno $alumnoalumno)
    {
        $this->alumnoalumno->removeElement($alumnoalumno);
    }

    /**
     * Get alumnoalumno
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlumnoalumno()
    {
        return $this->alumnoalumno;
    }
    public function __toString(){
        return (string)$this->getFecha()->format('Y-m-d H:i:s');
    }
}
