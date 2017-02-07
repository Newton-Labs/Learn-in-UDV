<?php

namespace DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DocumentoActividad.
 *
 * @ORM\Table(name="documento_actividad")
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="DocumentBundle\Repository\DocumentoActividadRepository")
 */
class DocumentoActividad
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_subido", type="datetime")
     */
    private $fechaSubido;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="document", fileNameProperty="documentName",
     * nullable=true)
     *
     * @Assert\File(
     * maxSize="32M",
     * mimeTypes = {
     *     "application/pdf",
     *     "application/x-pdf",
     *     "application/msword",
     *     "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
     *     "application/vnd.ms-excel",
     *     "application/vnd.ms-excel.sheet.macroenabled.12",
     *     "application/vnd.openxmlformats-officedocument.presentationml.presentation",
     *     "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
     *     "application/vnd.ms-powerpoint",
     *     "image/png",
     *     "image/jpeg",
     *     "text/*",
     *     "text/plain",
     *     "application/xml",
     *     "image/vnd.adobe.photoshop",
     *     "image/bmp"
     *    },
     * mimeTypesMessage = "Por favor solo subir archivos PDF o Word ",
     * )
     *
     * @var File
     */
    private $documentFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $mensajeEnvio;

    /**
     * @ORM\ManyToOne(targetEntity="Actividad")
     */
    private $actividad;

    /**
     * @ORM\Column(type="string", length=255, unique=false)
     *
     * @var string
     */
    private $documentName;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Usuario")
     */
    private $subidoPor;

    public function __construct()
    {
        $this->fechaSubido = new \DateTime();
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setDocumentFile(File $file = null)
    {
        $this->documentFile = $file;

        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getDocumentFile()
    {
        return $this->documentFile;
    }

    /**
     * @param string $imageName
     */
    public function setDocumentName($docName)
    {
        $this->documentName = $docName;
    }

    /**
     * Crear nombre único .
     */
    public function createUniqueDocumentName()
    {
        //arreglo para que los documentos sean únicos y no se sobreescriban en AMWS
        $this->setDocumentName(
            $this->getId().'-'.$this->getDocumentName()
            )
        ;
    }

    /**
     * @return string
     */
    public function getDocumentName()
    {
        $returnNombre = $this->documentName;
        //return substr($returnNombre,strpos($returnNombre,'-')+1,$returnNombre);
        return $returnNombre;
    }
    /**
     * modificar get para quitar el id del nombre del documento.
     *
     * @return string
     */
    public function getDocumentFixedName()
    {
        $nombre = $this->documentName;

        return substr($nombre, strrpos($nombre, '_') + 1, strlen($nombre));
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * Set fechaSubido.
     *
     * @param \DateTime $fechaSubido
     *
     * @return DocumentoActividad
     */
    public function setFechaSubido($fechaSubido)
    {
        $this->fechaSubido = $fechaSubido;

        return $this;
    }

    /**
     * Get fechaSubido.
     *
     * @return \DateTime
     */
    public function getFechaSubido()
    {
        return $this->fechaSubido;
    }

    /**
     * Set documento.
     *
     * @param \DocumentBundle\Entity\Documento $documento
     *
     * @return DocumentoActividad
     */
    public function setDocumento(\DocumentBundle\Entity\Documento $documento = null)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento.
     *
     * @return \DocumentBundle\Entity\Documento
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set actividad.
     *
     * @param \DocumentBundle\Entity\Actividad $actividad
     *
     * @return DocumentoActividad
     */
    public function setActividad(\DocumentBundle\Entity\Actividad $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad.
     *
     * @return \DocumentBundle\Entity\Actividad
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set subidoPor.
     *
     * @param \UserBundle\Entity\Usuario $subidoPor
     *
     * @return DocumentoActividad
     */
    public function setSubidoPor(\UserBundle\Entity\Usuario $subidoPor = null)
    {
        $this->subidoPor = $subidoPor;

        return $this;
    }

    /**
     * Get subidoPor.
     *
     * @return \UserBundle\Entity\Usuario
     */
    public function getSubidoPor()
    {
        return $this->subidoPor;
    }

    /**
     * Set mensajeEnvío.
     *
     * @param string $mensajeEnvío
     *
     * @return DocumentoActividad
     */
    public function setMensajeEnvio($mensajeEnvio)
    {
        $this->mensajeEnvio = $mensajeEnvio;

        return $this;
    }

    /**
     * Get mensajeEnvío.
     *
     * @return string
     */
    public function getMensajeEnvio()
    {
        return $this->mensajeEnvio;
    }

    public function __toString()
    {
        return $this->getDocumentFixedName();
    }
}
