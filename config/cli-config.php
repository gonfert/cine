<?php
/*
 *  Configuracion del interfaz de linea de comandos (CLI) de Doctrine.
 */

// Dependencia del objeto ConsoleRunner   
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// Incluimos el bootstrap de la aplicacion para obtener el 'Entity Manager'
require_once __DIR__.'/../src/bootstrap.php';

// Devolvemos el objeto HelperSet de consola
return ConsoleRunner::createHelperSet($entityManager);

