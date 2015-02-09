<?php
/**
 * Description of LoadEtiquetasData
 *
 */

namespace Cine\DataFixtures;

use Cine\Entity\Etiqueta;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/*
 *  Clase para la carga de datos de la entidad Etiquetas (asociadas a Peliculas)
 */
class LoadEtiquetasData implements FixtureInterface, DependentFixtureInterface {
    
    /*
     *  Metodo del interfaz 'FixtureInterface' a implementar 
     */   
    public function load(ObjectManager $manager) {
        
        $num_etiquetas = 5;
        
        // Preparamos un array de etiquetas
        $etiquetas = [];
        for ($i = 1; $i <= $num_etiquetas; $i++) {
            $etiqueta = new Etiqueta();
            $etiqueta->setNombre(sprintf("Etiqueta%d", $i));
            $etiquetas[] = $etiqueta;
        }                
        
        // Obtenemos la lista de peliculas
        $peliculas = $manager->getRepository('Cine\Entity\Pelicula')->findAll();    
        
        // Agregamos un nuermo aleatorio de etiquetas a cada pelicula
        $agregar = rand(1, $num_etiquetas);
        foreach ($peliculas as $p) {
            for ($i = 0; $i < $agregar; $i++) {
                $p->addEtiqueta( $etiquetas[$i]);
            }
            $agregar = rand(1, $num_etiquetas);
        }        
        
        // Persistimos entidades gestionadas
        $manager->flush();
    }   
    
    /*
     *  Metodo del interfaz 'DependentFixtureInterface' a implementar 
     */     
    public function getDependencies() {
        return ['Cine\DataFixtures\LoadPeliculasData'];             
    }

}
