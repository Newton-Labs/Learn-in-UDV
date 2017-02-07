<?php

namespace CursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Carrera.
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("nombreCarrera")
 */
class Carrera
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
     * @var string
     *
     * @ORM\Column(name="nombre_carrera", type="string", length=255)
     */
    private $nombreCarrera;

    /**
     * Bi-direccional de asociación. Cada carrera pertenece a una.
     *
     * @ORM\ManyToOne(targetEntity="Facultad", inversedBy="arrayCarreras")
     *
     * @var Weak-Side of entity relationship
     */
    private $facultad;

    /**
     * @ORM\OneToMany(targetEntity="Seccion", mappedBy="carrera")
     *
     * @var [type]
     */
    private $seccion;

    public function __construct()
    {
        $this->seccion = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreCarrera.
     *
     * @param string $nombreCarrera
     *
     * @return Carrera
     */
    public function setNombreCarrera($nombreCarrera)
    {
        $this->nombreCarrera = $nombreCarrera;

        return $this;
    }

    /**
     * Get nombreCarrera.
     *
     * @return string
     */
    public function getNombreCarrera()
    {
        return $this->nombreCarrera;
    }

    /**
     * Set facultad.
     *
     * @param \CursoBundle\Entity\Facultad $facultad
     *
     * @return Carrera
     */
    public function setFacultad(\CursoBundle\Entity\Facultad $facultad = null)
    {
        $this->facultad = $facultad;

        return $this;
    }

    /**
     * Get facultad.
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

    /**
     * Add seccion.
     *
     * @param \CursoBundle\Entity\Seccion $seccion
     *
     * @return Carrera
     */
    public function addSeccion(\CursoBundle\Entity\Seccion $seccion)
    {
        $this->seccion[] = $seccion;

        return $this;
    }

    /**
     * Remove seccion.
     *
     * @param \CursoBundle\Entity\Seccion $seccion
     */
    public function removeSeccion(\CursoBundle\Entity\Seccion $seccion)
    {
        $this->seccion->removeElement($seccion);
    }

    /**
     * Get seccion.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeccion()
    {
        return $this->seccion;
    }
}
