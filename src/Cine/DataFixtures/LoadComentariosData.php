<?php
/**
 * Description of LoadComentariosData
 *
 */

namespace Cine\DataFixtures;

use Cine\Entity\Comentario;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/*
 *  Clase para la carga de datos de la entidad Comentarios (asociados a Peliculas)
 */
class LoadComentariosData implements FixtureInterface, DependentFixtureInterface {
    
    // Array de datos de ejemplo
    private $datos = [
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat diam lacus, sed euismod ligula consectetur vel. Fusce semper eros tempus accumsan malesuada.",        
        "Fusce id elementum mi. Phasellus suscipit nunc sit amet cursus lacinia. Sed luctus sed diam sed auctor. Quisque fringilla ante id sapien feugiat, quis laoreet enim consectetur.",       
        "Quisque sapien enim, congue vitae luctus a, scelerisque sed leo. Integer tempor sagittis neque, at tincidunt turpis posuere ac.",       
        "Sed porta in velit quis interdum. Nunc faucibus egestas est ut sagittis. Integer maximus eu dui eu consequat. Curabitur consectetur magna ut arcu ultricies rhoncus.",
        "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In auctor mi vehicula sapien imperdiet dignissim. Duis ultrices sagittis mauris.",
        "Duis ultrices sagittis mauris, sit amet tincidunt massa porta sed. Proin porttitor, metus ut cursus posuere, lectus est interdum neque, eu porta nulla nulla sit amet dui.",
        "Nunc rutrum est nec vehicula eleifend. Maecenas vitae aliquam orci. In gravida, elit eu maximus lobortis, orci urna ornare arcu, pellentesque quam nunc id augue. ",
        "Nullam mollis blandit quam nec tincidunt. Etiam lorem orci, ornare eget efficitur non, tempor vel odio. Sed a magna viverra, lobortis purus eu, pulvinar nibh.",       
        "Maecenas efficitur imperdiet metus id gravida. Donec convallis leo lacus, nec feugiat turpis ullamcorper vel. Proin erat sem, dignissim sed lectus sit amet, egestas dignissim orci.",       
        "Suspendisse massa lorem, tempus id varius id, dictum id dui. Etiam sed sollicitudin felis. Cras porta ac lectus id maximus. Maecenas sed justo bibendum, consequat diam quis.",        
    ];
    
    /*
     *  Metodo del interfaz 'FixtureInterface' a implementar 
     */    
    public function load(ObjectManager $manager) {
        
        $numComentarios = 5;
        
        // Obtenemos la lista de peliculas
        $peliculas = $manager->getRepository('Cine\Entity\Pelicula')->findAll();
        
        foreach ($peliculas as $p) {
            
            // # aleatorio de comentarios por pelicula (pero al menos uno).
            $total = mt_rand(1, $numComentarios);            
            
            for ($i = 1; $i <= $total; $i++) {
                $comentario = new Comentario();
                $comentario
                    ->setTexto($this->datos[$i])
                    ->setFecha(new \DateTime(sprintf('-%d weeks', $total - $i)))
                    ->setPelicula($p);
                
                // Gestionamos entidad
                $manager->persist($comentario);
            }
        }
        
        // Persistimos las entidades
        $manager->flush();
    }        

    /*
     *  Metodo del interfaz 'DependentFixtureInterface' a implementar 
     */    
    public function getDependencies() {
        return ['Cine\DataFixtures\LoadPeliculasData'];        
    }

}
