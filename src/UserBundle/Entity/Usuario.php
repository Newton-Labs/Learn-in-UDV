<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//sirve para extender de friendofsymfony
use FOS\UserBundle\Entity\User as BaseUser;

//sirve para validar los campos del formulario

/**
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario extends BaseUser
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * Apellidos del usuario.
     *
     * @var string
     * @ORM\Column(name="apellidos",type="string",length=50)
     */
    private $apellidos;

    /**
     * @ORM\ManyToMany(targetEntity="CursoBundle\Entity\Curso", inversedBy="usuarios")
     * @ORM\JoinTable(name="cursos_usuario")
     **/
    private $cursos;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();// construye los metodos y atributos de Base
        $this->cursos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos.
     *
     * @param string $apellidos
     *
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos.
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }
    /**
     * Add cursos.
     *
     * @param \CursoBundle\Entity\Curso $cursos
     *
     * @return Usuario
     */
    public function addCurso(\CursoBundle\Entity\Curso $cursos)
    {
        $this->cursos[] = $cursos;

        return $this;
    }
    /**
     * Remove cursos.
     *
     * @param \CursoBundle\Entity\Curso $cursos
     */
    public function removeCurso(\CursoBundle\Entity\Curso $cursos)
    {
        $this->cursos->removeElement($cursos);
    }
    /**
     * Get cursos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursos()
    {
        return $this->cursos;
    }
    /**
     * Get expiresAt.
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentials_expire_at.
     *
     * @return \DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }
    public function __toString()
    {
        return $this->nombre.' '.$this->apellidos;
    }

    public function hasRole($role)
    {
        if (in_array($role, $this->getRoles())) {
            return true;
        }

        return false;
    }
}
