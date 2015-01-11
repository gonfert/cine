<?php
/**
 * Description of LoadPeliculasData
 * 
 */

namespace Cine\DataFixtures;

use Cine\Entity\Pelicula;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/*
 *  Clase para la carga de datos de la entidad Peliculas
 */
class LoadPeliculasData implements FixtureInterface {

    // Array de datos de ejemplo
    private $datos = [
        
        ['titulo'=>'Un puente lejano', 'titulo_original'=>'A bridge too far', 'director'=>'Richard Attenborough', 'anyo'=>'1977'],
        ['titulo'=>'Matrix', 'titulo_original'=>'Matrix', 'director'=>'Wachowski Brothers', 'anyo'=>'1999'],
        ['titulo'=>'Nivel 13', 'titulo_original'=>'The Thirteenth Floor ', 'director'=>'Josef Rusnak', 'anyo'=>'1999'],
        ['titulo'=>'Blade Runner', 'titulo_original'=>'Blade Runner', 'director'=>'Ridley Scott', 'anyo'=>''],
        ['titulo'=>'Moon', 'titulo_original'=>'Moon', 'director'=>'Duncan Jones', 'anyo'=>'2009'],
        
        ['titulo'=>'Brazil', 'titulo_original'=>'Brazil', 'director'=>'Terry Gilliam', 'anyo'=>'1985'],
        ['titulo'=>'El crepusculo de los dioses','titulo_original'=>'Sunset Bulevard', 'director'=>'Billy Wilder', 'anyo'=>'1950'],
        ['titulo'=>'La cosa', 'titulo_original'=>'The thing', 'director'=>'John Carpenter', 'anyo'=>'1982'],
        ['titulo'=>'Alien, el octavo pasajero', 'titulo_original'=>'Alien', 'director'=>'Ridley Scott', 'anyo'=>'1979'],
        ['titulo'=>'La guerra de las galaxias', 'titulo_original'=>'Star Wars', 'director'=>'George Lucas', 'anyo'=>'1977'],  
         
        ['titulo'=>'Tiburon', 'titulo_original'=>'Jaws', 'director'=>'Steven Spielberg', 'anyo'=>'1975'],
        ['titulo'=>'El golpe','titulo_original'=>'The sting', 'director'=>'George Roy Hill', 'anyo'=>'1973'],
        ['titulo'=>'Primera Plana', 'titulo_original'=>'The front page', 'director'=>'Billy Wilder', 'anyo'=>'1974'],
        ['titulo'=>'Todos los hombres del presidente', 'titulo_original'=>'All the president\'s men', 'director'=>'Alan J. Pakula', 'anyo'=>'1976'],
        ['titulo'=>'Existenz', 'titulo_original'=>'Existenz', 'director'=>'David Cronenberg', 'anyo'=>'1999'],     
        
       ];
    
    /*
     *  Metodo del interfaz 'FixtureInterface' a implementar 
     */
    public function load(ObjectManager $manager) {
        
        foreach ($this->datos as $p)
        {   
            // Creamos un nuevo objeto de la entidad (estado = NEW)
            $pelicula = new Pelicula();
            
            // Informamos los atributos de nuestra entidad
            $pelicula
                ->setTitulo( $p['titulo'] )
                ->setTituloOriginal( $p['titulo_original'] )
                ->setDirector( $p['director'] )
                ->setAnyo( $p['anyo'] );
            
            // Hacemos que la nueva entidad pase a ser gestionada (estado = MANAGED)
            $manager->persist($pelicula);
        }
        
        // Persistimos las entidades gestionadas
        $manager->flush();        
    }

}
