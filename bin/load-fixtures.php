<?php
/*
 * Name  : load-fixtures.php
 * 
 * Author: jr
 * Time  : 22:51:48
 * Date  : 05-ene-2015
 * 
 *  Script para la carga de datos para pruebas de las entidades
 * 
 */

// Incluimos nuestro bootstrap para tener acceso al 'EntityManager'
require_once __DIR__.'/../src/bootstrap.php';

// Resolvemos dependencias de clases
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

// Obtenenos un cargador indicando la ruta de las clases que implementan 'FixtureInterface'
$loader = new Loader();
$loader->loadFromDirectory(__DIR__.'/../src/Cine/DataFixtures');

// Objeto para purgado (vaciado) de entidades
$purger = new ORMPurger();

// Objeto que ejecutara la carga de datos
$executor = new ORMExecutor($entityManager, $purger);
$executor->execute($loader->getFixtures());
