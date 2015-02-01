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
 *  @Entity( repositoryClass="PeliculaRepository" )
 *  @Table( name="movie", indexes={ @Index(name="year_idx", columns="year") } )
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
     * @ManyToMany(
     *      targetEntity="Etiqueta", 
     *      inversedBy="peliculas", 
     *      fetch="EAGER", 
     *      cascade={"persist"}, orphanRemoval=true
     * )
     * @JoinTable(
     *      name="movie_tag",
     *      inverseJoinColumns={ @JoinColumn(name="tag_name", referencedColumnName="name") }
     * )
     * 
     * Notas: 
     * El criterio de obtencion (fetch) de las entidades relacionadas es LAZY. 
     * Esto implica una segunda consulta SQL en el caso de querer acceder a sus datos.
     * Cambiandolo a 'fetch=EAGER' se introduce un JOIN en el SQL generado, haciendo
     * que Doctrine ponga esos datos como disponibles en una sola consulta.
     * Conseguimos mejor rendimiento SQL a costa de mayor consumo de memoria.
     * 
     * El valor 'persist' de la opcion 'casacade', permite que las entidades asociadas
     * creadas con new() sean gestionadad automaticamente por doctrine sin necesidad de
     * hace un persist() en cada una de ellas.
     * 
     * 
     */
    protected $etiquetas;      
    
    /**
     * Inicializamos colecciones
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
    
    /**
     *  Implementacion segura de _clone() y __wake()
     * 
     */
    
    /*
    public function __clone()
    {
        // If the entity has an identity, proceed as normal.
        if ($this->id) {
            // ... Your code here as normal ...
        }
        // otherwise do nothing, do NOT throw an exception!
    }  

    public function __wakeup()
    {
        // If the entity has an identity, proceed as normal.
        if ($this->id) {
            // ... Your code here as normal ...
        }
        // otherwise do nothing, do NOT throw an exception!
    } 
 
     */   
    
}
