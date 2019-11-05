<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pregunta
 *
 * @ORM\Table(name="pregunta", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_AEE0E1F786387D5E", columns={"Materia_idMateria"})}, indexes={@ORM\Index(name="fk_Pregunta_Materia1_idx", columns={"Materia_idMateria"})})
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
     * @var \RoyalAcademyBundle\Entity\Materia
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Materia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Materia_idMateria", referencedColumnName="idMateria")
     * })
     */
     private $pregunta_idMateria;


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

    
}
