<?php

namespace CursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Periodo.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Periodo
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
     * @ORM\Column(name="nombrePeriodo", type="string", length=100)
     */
    private $nombrePeriodo;

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
     * Set nombrePeriodo.
     *
     * @param string $nombrePeriodo
     *
     * @return Periodo
     */
    public function setNombrePeriodo($nombrePeriodo)
    {
        $this->nombrePeriodo = $nombrePeriodo;

        return $this;
    }

    /**
     * Get nombrePeriodo.
     *
     * @return string
     */
    public function getNombrePeriodo()
    {
        return $this->nombrePeriodo;
    }

    /**
     * [__toString description].
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nombrePeriodo;
    }
}
