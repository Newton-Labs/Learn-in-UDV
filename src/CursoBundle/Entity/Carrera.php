<?php

namespace CursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrera
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Carrera
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreCarrera", type="string", length=255)
     */
    private $nombreCarrera;

    /**
     * Bi-direccional de asociación. Cada carrera pertenece a una 
     * 
     * @ORM\ManyToOne(targetEntity="Facultad", inversedBy="arrayCarreras")
     * @var  Weak-Side of entity relationship
     * 
     */
    private $facultad;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreCarrera
     *
     * @param string $nombreCarrera
     * @return Carrera
     */
    public function setNombreCarrera($nombreCarrera)
    {
        $this->nombreCarrera = $nombreCarrera;

        return $this;
    }

    /**
     * Get nombreCarrera
     *
     * @return string 
     */
    public function getNombreCarrera()
    {
        return $this->nombreCarrera;
    }

    /**
     * Set facultad
     *
     * @param \CursoBundle\Entity\Facultad $facultad
     * @return Carrera
     */
    public function setFacultad(\CursoBundle\Entity\Facultad $facultad = null)
    {
        $this->facultad = $facultad;

        return $this;
    }

    /**
     * Get facultad
     *
     * @return \CursoBundle\Entity\Facultad 
     */
    public function getFacultad()
    {
        return $this->facultad;
    }


    public function toStringCarreraYFacultad()
    {
        return sprintf(
            '%s - %s',
            $this->getNombreCarrera(),
            $this->getFacultad()
        ); 
    }

    public function __toString()
    {
        return $this->getNombreCarrera();
    }
}
