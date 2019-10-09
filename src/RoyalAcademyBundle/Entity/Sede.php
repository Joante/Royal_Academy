<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sede
 *
 * @ORM\Table(name="sede", indexes={@ORM\Index(name="fk_Sede_Pais_idx", columns={"Pais_idPais"})})
 * @ORM\Entity
 */
class Sede
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
     * @ORM\Column(name="idSede", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idsede;

    /**
     * @var \RoyalAcademyBundle\Entity\Pais
     *
     * @ORM\OneToOne(targetEntity="RoyalAcademyBundle\Entity\Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pais_idPais", referencedColumnName="idPais")
     * })
     */
    private $paispais;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Sede
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
     * Set idsede
     *
     * @param integer $idsede
     *
     * @return Sede
     */
    public function setIdsede($idsede)
    {
        $this->idsede = $idsede;

        return $this;
    }

    /**
     * Get idsede
     *
     * @return integer
     */
    public function getIdsede()
    {
        return $this->idsede;
    }

    /**
     * Set paispais
     *
     * @param \RoyalAcademyBundle\Entity\Pais $paispais
     *
     * @return Sede
     */
    public function setPaispais(\RoyalAcademyBundle\Entity\Pais $paispais)
    {
        $this->paispais = $paispais;

        return $this;
    }

    /**
     * Get paispais
     *
     * @return \RoyalAcademyBundle\Entity\Pais
     */
    public function getPaispais()
    {
        return $this->paispais;
    }
}
