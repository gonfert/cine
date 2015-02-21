<?php
/*
 * Name  : ejemplo_partial_select.php
 * 
 * Author: jr
 * Time  : 0:15:11
 * Date  : 22-feb-2015
 * 
 * Ejemplo del uso de seleccion parcial de una entidad.
 * 
 * La seleccion parcial debe usarse con cuidado ya que parte de las propiedades 
 * de la entidad no estarán disponibles, y por tanto, los metodos relacionados
 * dichas propiedades no podrán obtener su valor.
 * 
 * Si hacemos un refresh() de la entidad, el entity manager se encarga de volver
 * a solicitarla de forma completa.
 * 
 */

// Incluimos nuestro bootstrap para tener acceso al 'EntityManager'
require_once __DIR__.'/../src/bootstrap.php';

$dql = <<<DQL
SELECT PARTIAL p.{id, titulo, director} 
FROM Cine\Entity\Pelicula p 
WHERE p.id = 1
DQL;

// Seleccionamos
$qry = $entityManager->createQuery( $dql );
$resultado = $qry->getResult();

// DQL original
echo "DQL:\n". $dql . PHP_EOL . PHP_EOL;

// SQL generado
echo "SQL:\n". $qry->getSQL() . PHP_EOL . PHP_EOL;

// Obtenemos las propiedades (solo las solicitadas, el resto son nulas)
echo 'Id.............: ' . $resultado[0]->getId() . PHP_EOL;
echo 'Titulo.........: ' . $resultado[0]->getTitulo() . PHP_EOL;
echo 'Titulo Original: ' . $resultado[0]->getTituloOriginal() .PHP_EOL;
echo 'Director.......: ' . $resultado[0]->getDirector() . PHP_EOL;
echo 'Año............: ' . $resultado[0]->getAnyo(). PHP_EOL;

/*
 * Si hacemos un 'refresh' de la entidad. Obtendremos todos sus datos.
 */
$entityManager->refresh($resultado[0]);

echo "\nTras un refresh() de la entidad, podemos rescatar todos sus propiedades:\n\n";

// Volvemos a intentar obtener las propiedades
echo 'Id.............: ' . $resultado[0]->getId() . PHP_EOL;
echo 'Titulo.........: ' . $resultado[0]->getTitulo() . PHP_EOL;
echo 'Titulo Original: ' . $resultado[0]->getTituloOriginal() .PHP_EOL;
echo 'Director.......: ' . $resultado[0]->getDirector() . PHP_EOL;
echo 'Año............: ' . $resultado[0]->getAnyo(). PHP_EOL;