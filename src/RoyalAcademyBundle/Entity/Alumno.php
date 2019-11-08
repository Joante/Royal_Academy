<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alumno
 *
 * @ORM\Table(name="alumno", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1435D52D95440347", columns={"Usuario_idUsuario"})}, indexes={@ORM\Index(name="fk_Alumno_Sede1_idx", columns={"Sede_idSede"}), @ORM\Index(name="fk_Alumno_Usuario1_idx", columns={"Usuario_idUsuario"})})
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=55, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="DNI", type="bigint", nullable=false)
     */
    private $dni;

    /**
     * @var integer
     *
     * @ORM\Column(name="Edad", type="integer", nullable=false)
     */
    private $edad;

    /**
     * @var string
     *
     * @ORM\Column(name="Sexo", type="string", length=1, nullable=false)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=40, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAlumno", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idalumno;

    /**
     * @var \RoyalAcademyBundle\Entity\Sede
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Sede")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Sede_idSede", referencedColumnName="idSede")
     * })
     */
    private $sedesede;

    /**
     * @var \RoyalAcademyBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="RoyalAcademyBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Usuario_idUsuario", referencedColumnName="id")
     * })
     */
    private $usuariousuario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="RoyalAcademyBundle\Entity\Fechaexamen", inversedBy="alumnoalumno")
     * @ORM\JoinTable(name="alumno_has_fechaexamen",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Alumno_idAlumno", referencedColumnName="idAlumno")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="FechaExamen_idFechaExamen", referencedColumnName="idFechaExamen")
     *   }
     * )
     */
    private $fechaexamenfechaexamen;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="RoyalAcademyBundle\Entity\Materia", inversedBy="alumnoalumno")
     * @ORM\JoinTable(name="alumno_has_materia",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Alumno_idAlumno", referencedColumnName="idAlumno")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Materia_idMateria", referencedColumnName="idMateria")
     *   }
     * )
     */
    private $materiamateria;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaexamenfechaexamen = new \Doctrine\Common\Collections\ArrayCollection();
        $this->materiamateria = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Alumno
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
     * Set dni
     *
     * @param integer $dni
     *
     * @return Alumno
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return integer
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Alumno
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     *
     * @return Alumno
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Alumno
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
     * Get idalumno
     *
     * @return integer
     */
    public function getIdalumno()
    {
        return $this->idalumno;
    }

    /**
     * Set sedesede
     *
     * @param \RoyalAcademyBundle\Entity\Sede $sedesede
     *
     * @return Alumno
     */
    public function setSedesede(\RoyalAcademyBundle\Entity\Sede $sedesede = null)
    {
        $this->sedesede = $sedesede;

        return $this;
    }

    /**
     * Get sedesede
     *
     * @return \RoyalAcademyBundle\Entity\Sede
     */
    public function getSedesede()
    {
        return $this->sedesede;
    }

    /**
     * Set usuariousuario
     *
     * @param \RoyalAcademyBundle\Entity\Usuario $usuariousuario
     *
     * @return Alumno
     */
    public function setUsuariousuario(\RoyalAcademyBundle\Entity\Usuario $usuariousuario = null)
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

    /**
     * Add fechaexamenfechaexaman
     *
     * @param \RoyalAcademyBundle\Entity\Fechaexamen $fechaexamenfechaexaman
     *
     * @return Alumno
     */
    public function addFechaexamenfechaexaman(\RoyalAcademyBundle\Entity\Fechaexamen $fechaexamenfechaexaman)
    {
        $this->fechaexamenfechaexamen[] = $fechaexamenfechaexaman;

        return $this;
    }

    /**
     * Remove fechaexamenfechaexaman
     *
     * @param \RoyalAcademyBundle\Entity\Fechaexamen $fechaexamenfechaexaman
     */
    public function removeFechaexamenfechaexaman(\RoyalAcademyBundle\Entity\Fechaexamen $fechaexamenfechaexaman)
    {
        $this->fechaexamenfechaexamen->removeElement($fechaexamenfechaexaman);
    }

    /**
     * Get fechaexamenfechaexamen
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFechaexamenfechaexamen()
    {
        return $this->fechaexamenfechaexamen;
    }

    /**
     * Add materiamaterium
     *
     * @param \RoyalAcademyBundle\Entity\Materia $materiamaterium
     *
     * @return Alumno
     */
    public function addMateriamaterium(\RoyalAcademyBundle\Entity\Materia $materiamaterium)
    {
        $this->materiamateria[] = $materiamaterium;

        return $this;
    }

    /**
     * Remove materiamaterium
     *
     * @param \RoyalAcademyBundle\Entity\Materia $materiamaterium
     */
    public function removeMateriamaterium(\RoyalAcademyBundle\Entity\Materia $materiamaterium)
    {
        $this->materiamateria->removeElement($materiamaterium);
    }

    /**
     * Get materiamateria
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMateriamateria()
    {
        return $this->materiamateria;
    }

    public function __toString()
    {
        return (string) $this->nombre;
    }
}
