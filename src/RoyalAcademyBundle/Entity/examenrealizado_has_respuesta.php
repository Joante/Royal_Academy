<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * examenrealizado_has_respuesta
 *
 * @ORM\Table(name="examenrealizado_has_respuesta")
 * @ORM\Entity(repositoryClass="RoyalAcademyBundle\Repository\examenrealizado_has_respuestaRepository")
 */
class examenrealizado_has_respuesta
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="respuesta_idrespuesta", type="integer")
     */
    private $respuestaIdrespuesta;

    /**
     * @var int
     *
     * @ORM\Column(name="ExamenRealizado_idExamenRealizado", type="integer")
     */
    private $examenRealizadoIdExamenRealizado;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set respuestaIdrespuesta
     *
     * @param integer $respuestaIdrespuesta
     *
     * @return examenrealizado_has_respuesta
     */
    public function setRespuestaIdrespuesta($respuestaIdrespuesta)
    {
        $this->respuestaIdrespuesta = $respuestaIdrespuesta;

        return $this;
    }

    /**
     * Get respuestaIdrespuesta
     *
     * @return int
     */
    public function getRespuestaIdrespuesta()
    {
        return $this->respuestaIdrespuesta;
    }

    /**
     * Set examenRealizadoIdExamenRealizado
     *
     * @param integer $examenRealizadoIdExamenRealizado
     *
     * @return examenrealizado_has_respuesta
     */
    public function setExamenRealizadoIdExamenRealizado($examenRealizadoIdExamenRealizado)
    {
        $this->examenRealizadoIdExamenRealizado = $examenRealizadoIdExamenRealizado;

        return $this;
    }

    /**
     * Get examenRealizadoIdExamenRealizado
     *
     * @return int
     */
    public function getExamenRealizadoIdExamenRealizado()
    {
        return $this->examenRealizadoIdExamenRealizado;
    }
}

