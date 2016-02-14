<?php

namespace CursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Facultad.
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("nombreFacultad")
 */
class Facultad
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
     * @ORM\Column(name="nombreFacultad", type="string", length=255)
     */
    private $nombreFacultad;

    /**
     * Carreras asociadas a la facultad.
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Carrera", mappedBy="facultad")
     */
    private $arrayCarreras;

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
     * Set nombreFacultad.
     *
     * @param string $nombreFacultad
     *
     * @return Facultad
     */
    public function setNombreFacultad($nombreFacultad)
    {
        $this->nombreFacultad = $nombreFacultad;

        return $this;
    }

    /**
     * Get nombreFacultad.
     *
     * @return string
     */
    public function getNombreFacultad()
    {
        return $this->nombreFacultad;
    }
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->arrayCarreras = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add arrayCarreras.
     *
     * @param \CursoBundle\Entity\Carrera $arrayCarreras
     *
     * @return Facultad
     */
    public function addArrayCarrera(\CursoBundle\Entity\Carrera $arrayCarreras)
    {
        $this->arrayCarreras[] = $arrayCarreras;

        return $this;
    }

    /**
     * Remove arrayCarreras.
     *
     * @param \CursoBundle\Entity\Carrera $arrayCarreras
     */
    public function removeArrayCarrera(\CursoBundle\Entity\Carrera $arrayCarreras)
    {
        $this->arrayCarreras->removeElement($arrayCarreras);
    }

    /**
     * Get arrayCarreras.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArrayCarreras()
    {
        return $this->arrayCarreras;
    }

    /**
     * Mostrar el nombre representativo de cada facultad.
     *
     * @return string [description]
     */
    public function __toString()
    {
        return 'Facultad '.$this->nombreFacultad;
    }
}
