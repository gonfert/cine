<?php  

// Dependecias de clases de Doctrine
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/*   
 *  Autocargador para librerias usadas por la aplicacion.
 *  - Librerias de Doctrine.
 *  - Librerias propias de la app (/src).
 *  - Librerias extra instaladas con composer.
 */
require_once __DIR__.'/../vendor/autoload.php';

/*
 *  Carga la configuracion de la aplicacion
 */
require_once __DIR__.'/../config/config.php';

/*
 *  Fijamos la ruta donde se almacenaran las entidades
 */
$entitiesPath = array(__DIR__.'/Cine/Entity');

/*
 *  Obtenemos la configuracion de los metadatos de las entidades a traves
 *  de las anotaciones.
 *  Para ello, pasamos la ruta donde se definen las entidades y el modo
 *  de trabajo. El modo de trabajo (desarrollo/produccion) $dev=true/false
 *  influye en las optimizaciones que usa doctrine en caches y metadatos. 
 */
$config = Setup::createAnnotationMetadataConfiguration($entitiesPath, $dev);

/*  
 * Obtenemos una instancia del 'Entity Manager' para la aplicacion de nuestro 
 * ejemplo. En aplicaciones reales deberia usarse el patrón DI.
 */
$entityManager = EntityManager::create($dbParams, $config); 

