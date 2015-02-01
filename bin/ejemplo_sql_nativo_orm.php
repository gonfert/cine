<?php
/*
 * Name  : ejemplo_sql_nativo_orm.php
 * 
 * Author: jr
 * Time  : 22:07:12
 * Date  : 01-feb-2015
 * 
 * Un ejemplo de uso de Doctrine con SQL Nativo, mapeando los resultados a
 * entidades de Doctrine, haciendo uso de la clase 'ResultSetMappingBuilder'.
 * 
 * Esta clase es utilizada internamente por Doctrine cuando usamos DQL.
 * 
 */

// Incluimos nuestro bootstrap para tener acceso al 'EntityManager'
require_once __DIR__.'/../src/bootstrap.php';

use Doctrine\ORM\Query\ResultSetMappingBuilder;

// Creamos una instancia del resultSetMappingBuilder
$rsmb = new ResultSetMappingBuilder($entityManager);

// Asignamos la entidad principal y su alias
$rsmb->addRootEntityFromClassMetadata('Cine\Entity\Pelicula', 'p');

// Asignamos la entidad relacionada (las peliculas tienen comentarios).
// Parametros:
//  1) Clase de la entidad relacionada
//  2) Alias de la entidad relacionada
//  3) Alias de la entidad principal
//  4) Nombre de la relacion entre ambas (En este caso, la propiedad 'comentarios' 
//     de la entidad p (pelicula) contiene la coleccion de entidades c (comentarios)
//  5) Array que mapea nombres de campos (alias) para evitar conflictos de nombres.
$rsmb->addJoinedEntityFromClassMetadata(
    'Cine\Entity\Comentario',
    'c',
    'p',
    'comentarios',
    [
        'id' => 'comment_id'
    ]
);        

// Ej SQL: Obtener el id, el titulo original, y todos los comentarios de las peliculas
// cuyo año de estreno sea posterior o igual al 1988
$sql = <<<SQL
SELECT movie.id, movie.original_title, comment.id as comment_id, comment.texto, comment.fecha
FROM movie INNER JOIN comment ON movie.id = comment.pelicula_id
WHERE movie.year >= 1988
ORDER BY movie.id, comment.fecha
SQL;

// Ejecutamos la consulta
$query = $entityManager->createNativeQuery($sql, $rsmb);
$result = $query->getResult();

// Mostramos resultados
// Ojo: Hemos creado las entidades pero no tienen todos sus campos informados.
//      Solo podremos preguntar por las propiedades que se corresponden a los campos
//      especificados en la claúsula SELECT. El resto serán nulos.
foreach($result as $res) {
    
    // Entidad principal (pelicula)
    echo sprintf("\nId: %d%s",$res->getId(),PHP_EOL);
    echo sprintf("Titulo: %s%s",$res->getTituloOriginal(),PHP_EOL);  
    
    // Obtenemos entidades vinculadas (comentarios)
    $comentarios = $res->getComentarios();
    if ($comentarios)
        echo "Comentarios:\n";
        {
        foreach ($comentarios as $com) {
            echo sprintf("(%s) '%s'%s",$com->getFecha()->format('Y-m-d'), $com->getTexto(),PHP_EOL);         
        }
    }
    
}