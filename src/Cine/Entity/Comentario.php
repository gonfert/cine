<?php

namespace Cine\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;

/**
 * Description of Comentarios
 * 
 *  @Entity
 *  @Table( name="comment" )
 */
class Comentario {
    
    /**
    * @var int
    *
    * @Id
    * @GeneratedValue
    * @Column(type="integer")
    */
    protected $id;
    
    /**
    * @var string
    *
    * @Column(type="text")
    */
    protected $texto;
    
    /**
    * @var \DateTime
    *
    * @Column(type="datetime")
    */
    protected $fecha;
    
    /**
    * @var Pelicula
    *
    * @ManyToOne(targetEntity="Pelicula", inversedBy="comentarios")
    */
    protected $pelicula;

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
     * Set texto
     *
     * @param string $texto
     * @return Comentario
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Comentario
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set pelicula
     *
     * @param \Cine\Entity\Pelicula $pelicula
     * @return Comentario
     */
    public function setPelicula(\Cine\Entity\Pelicula $pelicula = null)
    {
        $this->pelicula = $pelicula;

        return $this;
    }

    /**
     * Get pelicula
     *
     * @return \Cine\Entity\Pelicula 
     */
    public function getPelicula()
    {
        return $this->pelicula;
    }
}
