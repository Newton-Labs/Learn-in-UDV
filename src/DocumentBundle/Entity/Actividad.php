<?php

namespace DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actividad.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Actividad
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
     * @ORM\Column(name="nombreActividad", type="string", length=255)
     */
    private $nombreActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcionActividad", type="string", length=255)
     */
    private $descripcionActividad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPublicacion", type="datetime")
     */
    private $fechaPublicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaExpiracion", type="datetimetz")
     */
    private $fechaExpiracion;

    /**
     * @ORM\ManyToOne(targetEntity="CursoBundle\Entity\Curso")
     */
    private $curso;

    public function __construct()
    {
        $this->fechaPublicacion = new \DateTime();
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
     * Set nombreActividad.
     *
     * @param string $nombreActividad
     *
     * @return Actividad
     */
    public function setNombreActividad($nombreActividad)
    {
        $this->nombreActividad = $nombreActividad;

        return $this;
    }

    /**
     * Get nombreActividad.
     *
     * @return string
     */
    public function getNombreActividad()
    {
        return $this->nombreActividad;
    }

    /**
     * Set fechaPublicacion.
     *
     * @param \DateTime $fechaPublicacion
     *
     * @return Actividad
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fechaPublicacion.
     *
     * @return \DateTime
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * Set fechaExpiracion.
     *
     * @param \DateTime $fechaExpiracion
     *
     * @return Actividad
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;

        return $this;
    }

    /**
     * Get fechaExpiracion.
     *
     * @return \DateTime
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }

    /**
     * Set curso.
     *
     * @param \CursoBundle\Entity\Curso $curso
     *
     * @return Actividad
     */
    public function setCurso(\CursoBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso.
     *
     * @return \CursoBundle\Entity\Curso
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set descripcionActividad.
     *
     * @param string $descripcionActividad
     *
     * @return Actividad
     */
    public function setDescripcionActividad($descripcionActividad)
    {
        $this->descripcionActividad = $descripcionActividad;

        return $this;
    }

    /**
     * Get descripcionActividad.
     *
     * @return string
     */
    public function getDescripcionActividad()
    {
        return $this->descripcionActividad;
    }

    public function __toString()
    {
        return $this->nombreActividad;
    }
}
