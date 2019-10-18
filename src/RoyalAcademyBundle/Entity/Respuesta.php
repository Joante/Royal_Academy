<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respuesta
 *
 * @ORM\Table(name="respuesta", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_6C6EC5EE45A52D35", columns={"Pregunta_idPregunta"})}, indexes={@ORM\Index(name="fk_respuesta_Pregunta1_idx", columns={"Pregunta_idPregunta"})})
 * @ORM\Entity
 */
class Respuesta
{
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=45, nullable=true)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="esCorrecta", type="boolean", nullable=true)
     */
    private $escorrecta;

    /**
     * @var integer
     *
     * @ORM\Column(name="idrespuesta", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrespuesta;

    /**
     * @var \RoyalAcademyBundle\Entity\Pregunta
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Pregunta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pregunta_idPregunta", referencedColumnName="idPregunta")
     * })
     */
    private $preguntapregunta;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="RoyalAcademyBundle\Entity\Examenrealizado", inversedBy="respuestarespuesta")
     * @ORM\JoinTable(name="examenrealizado_has_respuesta",
     *   joinColumns={
     *     @ORM\JoinColumn(name="respuesta_idrespuesta", referencedColumnName="idrespuesta")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ExamenRealizado_idExamenRealizado", referencedColumnName="idExamenRealizado")
     *   }
     * )
     */
    private $examenrealizadoexamenrealizado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->examenrealizadoexamenrealizado = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Respuesta
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
     * Set escorrecta
     *
     * @param boolean $escorrecta
     *
     * @return Respuesta
     */
    public function setEscorrecta($escorrecta)
    {
        $this->escorrecta = $escorrecta;

        return $this;
    }

    /**
     * Get escorrecta
     *
     * @return boolean
     */
    public function getEscorrecta()
    {
        return $this->escorrecta;
    }

    /**
     * Get idrespuesta
     *
     * @return integer
     */
    public function getIdrespuesta()
    {
        return $this->idrespuesta;
    }

    /**
     * Set preguntapregunta
     *
     * @param \RoyalAcademyBundle\Entity\Pregunta $preguntapregunta
     *
     * @return Respuesta
     */
    public function setPreguntapregunta(\RoyalAcademyBundle\Entity\Pregunta $preguntapregunta = null)
    {
        $this->preguntapregunta = $preguntapregunta;

        return $this;
    }

    /**
     * Get preguntapregunta
     *
     * @return \RoyalAcademyBundle\Entity\Pregunta
     */
    public function getPreguntapregunta()
    {
        return $this->preguntapregunta;
    }

    /**
     * Add examenrealizadoexamenrealizado
     *
     * @param \RoyalAcademyBundle\Entity\Examenrealizado $examenrealizadoexamenrealizado
     *
     * @return Respuesta
     */
    public function addExamenrealizadoexamenrealizado(\RoyalAcademyBundle\Entity\Examenrealizado $examenrealizadoexamenrealizado)
    {
        $this->examenrealizadoexamenrealizado[] = $examenrealizadoexamenrealizado;

        return $this;
    }

    /**
     * Remove examenrealizadoexamenrealizado
     *
     * @param \RoyalAcademyBundle\Entity\Examenrealizado $examenrealizadoexamenrealizado
     */
    public function removeExamenrealizadoexamenrealizado(\RoyalAcademyBundle\Entity\Examenrealizado $examenrealizadoexamenrealizado)
    {
        $this->examenrealizadoexamenrealizado->removeElement($examenrealizadoexamenrealizado);
    }

    /**
     * Get examenrealizadoexamenrealizado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamenrealizadoexamenrealizado()
    {
        return $this->examenrealizadoexamenrealizado;
    }
    

    public function __toString()
    {
        return (string) $this->descripcion;
    }
}
