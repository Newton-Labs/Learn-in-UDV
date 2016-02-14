<?php

namespace CursoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Curso.
 *
 * @ORM\Table(name="curso")
 * @ORM\Entity()
 * @UniqueEntity(fields={"nombreCurso","sede","periodo","carreras","year"},
 *     message="El curso que está tratando de crear ya ha sido utilizado, cambie de período, nombre o carrera"
 * )
 */
class Curso
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
     * @ORM\Column(name="nombreCurso", type="string", length=255)
     * @ORM\OrderBy({"nombreCurso" = "ASC"})
     */
    private $nombreCurso;

    /**
     * Sede de la UDV.
     *
     * @var string
     * @ORM\Column(name="sede",type="string", length=255)
     */
    private $sede;

    /**
     * Período en que se imparte el curso.
     *
     * @var string
     * @ORM\ManyToOne(targetEntity="Periodo")
     */
    private $periodo;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=20)
     */
    private $year;

    /**
     *  Usuarios que asociados al curso.
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Usuario", mappedBy="cursos")
     **/
    private $usuarios;

    /**
     * Carrera asociada al curso.
     *
     * @ORM\ManyToOne(targetEntity="Carrera")
     */
    private $carreras;

    /**
     * [$documento cada curso tiene los documentos asociados].
     * 
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="DocumentBundle\Entity\Documento", mappedBy="curso")
     * @ORM\OrderBy({"numeroDocumento" = "ASC"})
     */
    private $documentos;

    /**
     * Sirve para hacer soft delete de la entidad.
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * Sirve para generar URL's a base de nombre curos y codigo curso
     * De esta forma no se muestra el id en el URL.
     *
     * @Gedmo\Slug(fields={"nombreCurso", "id"},updatable=true)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * Curso creado por.
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Usuario")
     */
    private $cursoCreadoPor;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->year = date_format(new \DateTime(), 'Y');
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
     * Set nombreCurso.
     *
     * @param string $nombreCurso
     *
     * @return Curso
     */
    public function setNombreCurso($nombreCurso)
    {
        $this->nombreCurso = $nombreCurso;

        return $this;
    }
    /**
     * Get nombreCurso.
     *
     * @return string
     */
    public function getNombreCurso()
    {
        return $this->nombreCurso;
    }

    /**
     * Add usuarios.
     *
     * @param \CursoBundle\Entity\Usuario $usuarios
     *
     * @return Curso
     */
    public function addUsuario(\UserBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;
        $usuarios->addCurso($this);

        return $this;
    }
    /**
     * Remove usuarios.
     *
     * @param \CursoBundle\Entity\Usuario $usuarios
     */
    public function removeUsuario(\UserBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
        $usuarios->removeCurso($this);
    }
    /**
     * Get usuarios.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add documentos.
     *
     * @param \DocumentBundle\Entity\Documento $documentos
     *
     * @return Curso
     */
    public function addDocumento(\DocumentBundle\Entity\Documento $documentos)
    {
        $this->documentos[] = $documentos;

        return $this;
    }
    /**
     * Remove documentos.
     *
     * @param \DocumentBundle\Entity\Documento $documentos
     */
    public function removeDocumento(\DocumentBundle\Entity\Documento $documentos)
    {
        $this->documentos->removeElement($documentos);
    }
    /**
     * Get documentos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    public function getCurso()
    {
        return $this;
    }

    /**
     * Set deletedAt.
     *
     * @param \DateTime $deletedAt
     *
     * @return Curso
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt.
     * 
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Curso
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set sede.
     *
     * @param string $sede
     *
     * @return Curso
     */
    public function setSede($sede)
    {
        $this->sede = $sede;

        return $this;
    }

    /**
     * Get sede.
     *
     * @return string
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * Set periodo.
     *
     * @param string $periodo
     *
     * @return Curso
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo.
     *
     * @return string
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set carreras.
     *
     * @param \CursoBundle\Entity\Carrera $carreras
     *
     * @return Curso
     */
    public function setCarreras(\CursoBundle\Entity\Carrera $carreras = null)
    {
        $this->carreras = $carreras;

        return $this;
    }

    /**
     * Set year.
     *
     * @param \DateTime $year
     *
     * @return Curso
     */
    public function setyear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year.
     *
     * @return \DateTime
     */
    public function getyear()
    {
        return $this->year;
    }

    /**
     * Get carreras.
     *
     * @return \CursoBundle\Entity\Carrera
     */
    public function getCarreras()
    {
        return $this->carreras;
    }

    public function __toString()
    {
        return (string) $this->nombreCurso;
    }

    /**
     * El método es llamado para mostrar los dos atributos en el select2.
     *
     * @return string obtener el nombre y el codigo en un solo método .
     */
    public function getCodigoNombre()
    {
        return sprintf(
            '%s-%s',
            $this,
            $this->getCursoCreadoPor()
        );
    }


    /**
     * Set cursoCreadoPor
     *
     * @param \UserBundle\Entity\Usuario $cursoCreadoPor
     * @return Curso
     */
    public function setCursoCreadoPor(\UserBundle\Entity\Usuario $cursoCreadoPor = null)
    {
        $this->cursoCreadoPor = $cursoCreadoPor;

        return $this;
    }

    /**
     * Get cursoCreadoPor
     *
     * @return \UserBundle\Entity\Usuario 
     */
    public function getCursoCreadoPor()
    {
        return $this->cursoCreadoPor;
    }
}
