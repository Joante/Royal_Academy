<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pregunta
 *
 * @ORM\Table(name="pregunta", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_AEE0E1F786387D5E", columns={"Examen_idExamen"})}, indexes={@ORM\Index(name="fk_Pregunta_Examen1_idx", columns={"Examen_idExamen"})})
 * @ORM\Entity
 */
class Pregunta
{
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=45, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPregunta", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpregunta;

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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Pregunta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get idpregunta
     *
     * @return integer
     */
    public function getIdpregunta()
    {
        return $this->idpregunta;
    }

    /**
     * Set examenexamen
     *
     * @param \RoyalAcademyBundle\Entity\Examen $examenexamen
     *
     * @return Pregunta
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