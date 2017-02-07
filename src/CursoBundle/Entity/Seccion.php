<?php

namespace CursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seccion.
 *
 * @ORM\Table(name="seccion")
 * @ORM\Entity(repositoryClass="CursoBundle\Repository\SeccionRepository")
 */
class Seccion
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
     * @ORM\Column(name="nombre_seccion", type="string", length=255, unique=true)
     */
    private $nombreSeccion;

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
     * Set nombreSeccion
     *n.
     *
     * @param string $nombreSeccion
     *
     * @return Seccion
     */
    public function setNombreSeccion($nombreSeccion)
    {
        $this->nombreSeccion = $nombreSeccion;

        return $this;
    }

    /**
     * Get nombreSeccion.
     *
     * @return string
     */
    public function getNombreSeccion()
    {
        return $this->nombreSeccion;
    }

    public function __toString()
    {
        return $this->nombreSeccion;
    }
}
