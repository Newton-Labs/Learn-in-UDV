<?php

namespace CursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horario
 *
 * @ORM\Table(name="horario")
 * @ORM\Entity(repositoryClass="CursoBundle\Repository\HorarioRepository")
 */
class Horario
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
     * @ORM\Column(name="dia", type="string", length=255, unique=true)
     */
    private $dia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="datetime")
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_final", type="datetime")
     */
    private $horaFinal;


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
     * Set dia
     *
     * @param string $dia
     * @return Horario
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return string 
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     * @return Horario
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime 
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFinal
     *
     * @param \DateTime $horaFinal
     * @return Horario
     */
    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }

    /**
     * Get horaFinal
     *
     * @return \DateTime 
     */
    public function getHoraFinal()
    {
        return $this->horaFinal;
    }
}
