<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rolusuario
 *
 * @ORM\Table(name="rolusuario")
 * @ORM\Entity
 */
class Rolusuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="Rol", type="string", length=45, nullable=false)
     */
    private $rol;

    /**
     * @var integer
     *
     * @ORM\Column(name="idRolUsuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrolusuario;



    /**
     * Set rol
     *
     * @param string $rol
     *
     * @return Rolusuario
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Get idrolusuario
     *
     * @return integer
     */
    public function getIdrolusuario()
    {
        return $this->idrolusuario;
    }
}
