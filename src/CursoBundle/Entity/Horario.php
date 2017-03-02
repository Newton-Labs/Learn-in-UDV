<?php

namespace CursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Horario.
 *
 * @ORM\Table(name="horario")
 * @ORM\Entity(repositoryClass="CursoBundle\Repository\HorarioRepository")
 * @UniqueEntity(
 *     fields={"dia", "horaInicio", "horaFinal"})
 */
class Horario
{
    const horario = [
        'Lunes' => 1, 
        'Martes' => 2, 
        'Miércoles' => 3, 
        'Jueves' => 4,
        'Viernes' => 5, 
        'Sábado' => 6
    ];

    const horarioInv = [
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado'
    ];

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
     * @ORM\Column(name="dia", type="string", length=255)
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dia.
     *
     * @param string $dia
     *
     * @return Horario
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia.
     *
     * @return string
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set horaInicio.
     *
     * @param \DateTime $horaInicio
     *
     * @return Horario
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio.
     *
     * @return \DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFinal.
     *
     * @param \DateTime $horaFinal
     *
     * @return Horario
     */
    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }

    /**
     * Get horaFinal.
     *
     * @return \DateTime
     */
    public function getHoraFinal()
    {
        return $this->horaFinal;
    }

    public function __toString() 
    {
        return array_search($this->dia, Horario::horario).' de '.$this->horaInicio->format('H:i').' a '.$this->horaFinal->format('H:i');
    }
}
