<?php

namespace RoyalAcademyBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario extends BaseUser
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


   

    /**
     * Get idusuario
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
