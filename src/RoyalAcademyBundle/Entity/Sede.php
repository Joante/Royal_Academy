<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sede
 *
 * @ORM\Table(name="sede", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_2A9BE2D196FCEA96", columns={"Pais_idPais"})}, indexes={@ORM\Index(name="fk_Sede_Pais_idx", columns={"Pais_idPais"})})
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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsede;

    /**
     * @var \RoyalAcademyBundle\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Pais")
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
    public function setPaispais(\RoyalAcademyBundle\Entity\Pais $paispais = null)
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

    public function __toString()
    {
        return (string) $this->getNombre();
    }
}
