<?php

namespace Cine\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Pelicula
 * 
 *  @Entity(repositoryClass="PeliculaRepository")
 *  @Table( indexes={ @Index(name="year_idx", columns="year") },  name="movie" )
 * 
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
     * @var Comentario[]
     * 
     * @OneToMany(targetEntity="Comentario", mappedBy="pelicula")
     */
    protected $comentarios;    
    
    /**
     * @var Etiqueta[]
     *
     * @ManyToMany(targetEntity="Etiqueta", inversedBy="peliculas", fetch="EAGER", cascade={"persist"}, orphanRemoval=true)
     * @JoinTable(
     *      name="movie_tag",
     *      inverseJoinColumns={ @JoinColumn(name="tag_name", referencedColumnName="name") }
     * )
     */
    protected $etiquetas;      
    
    /**
     * Inicializamos colleciones
     */
    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->etiquetas = new ArrayCollection();
    }        

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

    /**
     * Add comentarios
     *
     * @param \Cine\Entity\Comentario $comentarios
     * @return Pelicula
     */
    public function addComentario(\Cine\Entity\Comentario $comentarios)
    {
        $this->comentarios[] = $comentarios;
        $comentarios->setPelicula($this);
        
        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param \Cine\Entity\Comentario $comentarios
     */
    public function removeComentario(\Cine\Entity\Comentario $comentarios)
    {
        $this->comentarios->removeElement($comentarios);
    }

    /**
     * Get comentarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Add etiquetas
     *
     * @param \Cine\Entity\Etiqueta $etiquetas
     * @return Pelicula
     */
    public function addEtiqueta(\Cine\Entity\Etiqueta $etiquetas)
    {
        $this->etiquetas[] = $etiquetas;

        return $this;
    }

    /**
     * Remove etiquetas
     *
     * @param \Cine\Entity\Etiqueta $etiquetas
     */
    public function removeEtiqueta(\Cine\Entity\Etiqueta $etiquetas)
    {
        $this->etiquetas->removeElement($etiquetas);
    }

    /**
     * Get etiquetas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtiquetas()
    {
        return $this->etiquetas;
    }
}
