<?php
/*
 * Name  : ejemplo_sql_nativo_dbal.php
 * 
 * Author: jr
 * Time  : 21:50:44
 * Date  : 01-feb-2015
 * 
 * Un ejemplo de uso de Doctrine con SQL Nativo, sin mapear los resultados a 
 * entidades mediante Doctrine ORM. Solo utilizamos Doctrine DBAL como capa de 
 * abstraccion de datos.
 * 
 */

// Incluimos nuestro bootstrap para tener acceso al 'EntityManager'
require_once __DIR__.'/../src/bootstrap.php';

// Ej: Obtener el titulo en castellano de las 5 peliculas con mas comentarios
$sql = <<<SQL
SELECT spanish_title AS titulo, COUNT(comment.id) AS comentarios 
FROM movie JOIN comment ON comment.pelicula_id = movie.id
GROUP BY movie.id
ORDER BY comentarios DESC, spanish_title ASC
LIMIT 5;
SQL;

// Ejecutamos la consulta
$query = $entityManager->getConnection()->query($sql);
$result = $query->fetchAll();

//print "\n$sql\n\n"; // Debug

// Mostramos resultados
foreach($result as $res)
{
   echo sprintf("'%s', con %d comentarios %s",$res['titulo'],$res['comentarios'], PHP_EOL); 
}