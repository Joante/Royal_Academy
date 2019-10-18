<?php

namespace RoyalAcademyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * realizarExamen
 *
 * @ORM\Table(name="realizar_examen")
 * @ORM\Entity(repositoryClass="RoyalAcademyBundle\Repository\realizarExamenRepository")
 */
class realizarExamen
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Get id
     *
     * @return boolean
     */
    public function examenEnCurso()
    {
        return $this->id;
    }
}

