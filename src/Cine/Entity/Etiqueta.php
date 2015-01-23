<?php

namespace Cine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * Description of Etiqueta
 * 
 *  @Entity
 *  @Table( name="tag" )
 */
class Etiqueta {
    
    /**
     * @var string
     *
     * @Id
     * @Column(type="string", name="name")
     */
    protected $nombre;
    
    /**
     * @var Pelicula[]
     *
     * @ManyToMany(targetEntity="Pelicula", mappedBy="etiquetas")
     */
    protected $peliculas;
    
    /**
     * Inicializa la coleccion
     */
    public function __construct()
    {
        $this->peliculas = new ArrayCollection();
    }    


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Etiqueta
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add peliculas
     *
     * @param \Cine\Entity\Pelicula $peliculas
     * @return Etiqueta
     */
    public function addPelicula(\Cine\Entity\Pelicula $peliculas)
    {
        $this->peliculas[] = $peliculas;
        $peliculas->addEtiqueta($this);

        return $this;
    }

    /**
     * Remove peliculas
     *
     * @param \Cine\Entity\Pelicula $peliculas
     */
    public function removePelicula(\Cine\Entity\Pelicula $peliculas)
    {
        $this->peliculas->removeElement($peliculas);
    }

    /**
     * Get peliculas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPeliculas()
    {
        return $this->peliculas;
    }
    
    /**
     * Reescritura del metodo 'magico' __toString. Permite la impresion de un objeto de la clase
     * @return type string
     */
    public function __toString()
    {
        return $this->getNombre();
    }
}
