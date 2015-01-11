<?php

namespace Cine\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;

/**
 * Description of Pelicula
 *
 * @author jr
 * time: 19:00:18
 * date: 05-ene-2015
 * 
 * 
 *  @Entity
 *  @Table( indexes={ @Index(name="year_idx", columns="year") },  name="movie" )
 */
class Pelicula {
    
    /**
     * @var int
     * 
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     * 
     * Identificador
     */
    private $id;
    
    /**
     * @var string
     *
     * @Column(type="string", length=100, name="spanish_title")
     * 
     * Titulo comercial en España
     */
    private $titulo;
    
    /**
     * @var string
     *
     * @Column(type="string", length=100, name="original_title", nullable=false)
     * 
     * Titulo original
     */
    private $tituloOriginal;
 
    /**
     * @var string
     *
     * @Column(type="string", length=100)
     * 
     * Director
     */
    private $director;    
        
    /**
     * @var int
     * 
     * @Column(type="integer", name="year", nullable=false, options={"unsigned":true, "default":0})
     *
     * Año de realizacion de la pelicula 
     */
    private $anyo;
 

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
     * Set titulo
     *
     * @param string $titulo
     * @return Pelicula
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set tituloOriginal
     *
     * @param string $tituloOriginal
     * @return Pelicula
     */
    public function setTituloOriginal($tituloOriginal)
    {
        $this->tituloOriginal = $tituloOriginal;

        return $this;
    }

    /**
     * Get tituloOriginal
     *
     * @return string 
     */
    public function getTituloOriginal()
    {
        return $this->tituloOriginal;
    }

    /**
     * Set director
     *
     * @param string $director
     * @return Pelicula
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return string 
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set anyo
     *
     * @param integer $anyo
     * @return Pelicula
     */
    public function setAnyo($anyo)
    {
        $this->anyo = $anyo;

        return $this;
    }

    /**
     * Get anyo
     *
     * @return integer 
     */
    public function getAnyo()
    {
        return $this->anyo;
    }
}
