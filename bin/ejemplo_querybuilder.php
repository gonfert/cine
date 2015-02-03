<?php
/*
 * Name  : ejemplo_querybuilder.php
 * 
 * Author: jr
 * Time  : 23:49:13
 * Date  : 02-feb-2015
 */

// Incluimos nuestro bootstrap para tener acceso al 'EntityManager'
require_once __DIR__.'/../src/bootstrap.php';

use Doctrine\ORM\QueryBuilder;

// Creacion de un QueryBuilder
$qb = $entityManager->createQueryBuilder();
$qb->select('p')
   ->from('Cine\Entity\Pelicula', 'p')
   ->orderBy('p.titulo', 'ASC');

// Consulta DQL
$queryDQL = $qb->getDQL();

// Objeto Query asociado
$query = $qb->getQuery();

// Consulta SQL
$querySQL = $query->getSQL();

echo sprintf("\nConsulta DQL:\n%s%s", $queryDQL, PHP_EOL);
echo sprintf("\nConsulta SQL:\n%s%s", $querySQL, PHP_EOL);
