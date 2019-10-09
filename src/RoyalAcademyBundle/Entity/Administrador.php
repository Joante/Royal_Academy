<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administrador
 *
 * @ORM\Table(name="administrador", indexes={@ORM\Index(name="fk_Administrador_Usuario1_idx", columns={"Usuario_idUsuario"})})
 * @ORM\Entity
 */
class Administrador
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAdministrador", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $idadministrador;

    /**
     * @var \RoyalAcademyBundle\Entity\Usuario
     *
     *
     * @ORM\OneToOne(targetEntity="RoyalAcademyBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Usuario_idUsuario", referencedColumnName="idUsuario")
     * })
     */
    private $usuariousuario;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Administrador
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
     * Set email
     *
     * @param string $email
     *
     * @return Administrador
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set idadministrador
     *
     * @param integer $idadministrador
     *
     * @return Administrador
     */
    public function setIdadministrador($idadministrador)
    {
        $this->idadministrador = $idadministrador;

        return $this;
    }

    /**
     * Get idadministrador
     *
     * @return integer
     */
    public function getIdadministrador()
    {
        return $this->idadministrador;
    }

    /**
     * Set usuariousuario
     *
     * @param \RoyalAcademyBundle\Entity\Usuario $usuariousuario
     *
     * @return Administrador
     */
    public function setUsuariousuario(\RoyalAcademyBundle\Entity\Usuario $usuariousuario)
    {
        $this->usuariousuario = $usuariousuario;

        return $this;
    }

    /**
     * Get usuariousuario
     *
     * @return \RoyalAcademyBundle\Entity\Usuario
     */
    public function getUsuariousuario()
    {
        return $this->usuariousuario;
    }
}
