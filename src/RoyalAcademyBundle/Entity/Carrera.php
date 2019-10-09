<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrera
 *
 * @ORM\Table(name="carrera", indexes={@ORM\Index(name="fk_Carrera_Sede1_idx", columns={"Sede_idSede"})})
 * @ORM\Entity
 */
class Carrera
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
     * @ORM\Column(name="idCarrera", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idcarrera;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="RoyalAcademyBundle\Entity\Materia", mappedBy="carreracarrera")
     */
    private $materiamateria;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materiamateria = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Carrera
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
     * Set idcarrera
     *
     * @param integer $idcarrera
     *
     * @return Carrera
     */
    public function setIdcarrera($idcarrera)
    {
        $this->idcarrera = $idcarrera;

        return $this;
    }

    /**
     * Get idcarrera
     *
     * @return integer
     */
    public function getIdcarrera()
    {
        return $this->idcarrera;
    }

    /**
     * Set sedesede
     *
     * @param \RoyalAcademyBundle\Entity\Sede $sedesede
     *
     * @return Carrera
     */
    public function setSedesede(\RoyalAcademyBundle\Entity\Sede $sedesede)
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
     * Add materiamaterium
     *
     * @param \RoyalAcademyBundle\Entity\Materia $materiamaterium
     *
     * @return Carrera
     */
    public function addMateriamaterium(\RoyalAcademyBundle\Entity\Materia $materiamaterium)
    {
        $this->materiamateria[] = $materiamaterium;

        return $this;
    }

    /**
     * Remove materiamaterium
     *
     * @param \RoyalAcademyBundle\Entity\Materia $materiamaterium
     */
    public function removeMateriamaterium(\RoyalAcademyBundle\Entity\Materia $materiamaterium)
    {
        $this->materiamateria->removeElement($materiamaterium);
    }

    /**
     * Get materiamateria
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMateriamateria()
    {
        return $this->materiamateria;
    }
}
