<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pregunta
 *
 * @ORM\Table(name="pregunta", indexes={@ORM\Index(name="fk_Pregunta_Examen1_idx", columns={"Examen_idExamen"})})
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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idpregunta;

    /**
     * @var \RoyalAcademyBundle\Entity\Examen
     *
     * @ORM\OneToOne(targetEntity="RoyalAcademyBundle\Entity\Examen")
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
     * Set idpregunta
     *
     * @param integer $idpregunta
     *
     * @return Pregunta
     */
    public function setIdpregunta($idpregunta)
    {
        $this->idpregunta = $idpregunta;

        return $this;
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
    public function setExamenexamen(\RoyalAcademyBundle\Entity\Examen $examenexamen)
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
