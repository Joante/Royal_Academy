<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materia
 *
 * @ORM\Table(name="materia")
 * @ORM\Entity
 */
class Materia
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

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
     * @var integer
     *
     * @ORM\Column(name="idMateria", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmateria;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="RoyalAcademyBundle\Entity\Alumno", mappedBy="materiamateria")
     */
    private $alumnoalumno;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="RoyalAcademyBundle\Entity\Carrera", inversedBy="materiamateria")
     * @ORM\JoinTable(name="materia_has_carrera",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Materia_idMateria", referencedColumnName="idMateria")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Carrera_idCarrera", referencedColumnName="idCarrera")
     *   }
     * )
     */
    private $carreracarrera;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alumnoalumno = new \Doctrine\Common\Collections\ArrayCollection();
        $this->carreracarrera = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Materia
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set cantmax
     *
     * @param integer $cantmax
     *
     * @return Materia
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
     * @return Materia
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
     * Get idmateria
     *
     * @return integer
     */
    public function getIdmateria()
    {
        return $this->idmateria;
    }

    /**
     * Add alumnoalumno
     *
     * @param \RoyalAcademyBundle\Entity\Alumno $alumnoalumno
     *
     * @return Materia
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

    /**
     * Add carreracarrera
     *
     * @param \RoyalAcademyBundle\Entity\Carrera $carreracarrera
     *
     * @return Materia
     */
    public function addCarreracarrera(\RoyalAcademyBundle\Entity\Carrera $carreracarrera)
    {
        $this->carreracarrera[] = $carreracarrera;

        return $this;
    }

    /**
     * Remove carreracarrera
     *
     * @param \RoyalAcademyBundle\Entity\Carrera $carreracarrera
     */
    public function removeCarreracarrera(\RoyalAcademyBundle\Entity\Carrera $carreracarrera)
    {
        $this->carreracarrera->removeElement($carreracarrera);
    }

    /**
     * Get carreracarrera
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarreracarrera()
    {
        return $this->carreracarrera;
    }
}
