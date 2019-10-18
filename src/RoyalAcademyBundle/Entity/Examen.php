<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table(name="examen", indexes={@ORM\Index(name="fk_Examen_FechaExamen1_idx", columns={"FechaExamen_idFechaExamen"})})
 * @ORM\Entity
 */
class Examen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idExamen", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexamen;

    /**
     * @var \RoyalAcademyBundle\Entity\Fechaexamen
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Fechaexamen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FechaExamen_idFechaExamen", referencedColumnName="idFechaExamen")
     * })
     */
    private $fechaexamenfechaexamen;



    /**
     * Get idexamen
     *
     * @return integer
     */
    public function getIdexamen()
    {
        return $this->idexamen;
    }

    /**
     * Set fechaexamenfechaexamen
     *
     * @param \RoyalAcademyBundle\Entity\Fechaexamen $fechaexamenfechaexamen
     *
     * @return Examen
     */
    public function setFechaexamenfechaexamen(\RoyalAcademyBundle\Entity\Fechaexamen $fechaexamenfechaexamen = null)
    {
        $this->fechaexamenfechaexamen = $fechaexamenfechaexamen;

        return $this;
    }

    /**
     * Get fechaexamenfechaexamen
     *
     * @return \RoyalAcademyBundle\Entity\Fechaexamen
     */
    public function getFechaexamenfechaexamen()
    {
        return $this->fechaexamenfechaexamen;
    }
    public function __toString(){
        return (string)$this->getIdexamen();

    }
}
