<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="fk_Usuario_RolUsuario1_idx", columns={"RolUsuario_idRolUsuario"})})
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="Usuario", type="string", length=10, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="Contrasenia", type="string", length=45, nullable=false)
     */
    private $contrasenia;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuario;

    /**
     * @var \RoyalAcademyBundle\Entity\Rolusuario
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Rolusuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RolUsuario_idRolUsuario", referencedColumnName="idRolUsuario")
     * })
     */
    private $rolusuariorolusuario;



    /**
     * Set usuario
     *
     * @param string $usuario
     *
     * @return Usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set contrasenia
     *
     * @param string $contrasenia
     *
     * @return Usuario
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;

        return $this;
    }

    /**
     * Get contrasenia
     *
     * @return string
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    /**
     * Get idusuario
     *
     * @return integer
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set rolusuariorolusuario
     *
     * @param \RoyalAcademyBundle\Entity\Rolusuario $rolusuariorolusuario
     *
     * @return Usuario
     */
    public function setRolusuariorolusuario(\RoyalAcademyBundle\Entity\Rolusuario $rolusuariorolusuario = null)
    {
        $this->rolusuariorolusuario = $rolusuariorolusuario;

        return $this;
    }

    /**
     * Get rolusuariorolusuario
     *
     * @return \RoyalAcademyBundle\Entity\Rolusuario
     */
    public function getRolusuariorolusuario()
    {
        return $this->rolusuariorolusuario;
    }
}
