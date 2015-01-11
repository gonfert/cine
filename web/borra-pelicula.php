<?php
/*
 * Name  : borra-pelicula.php
 * 
 * Author: jr
 * Time  : 18:52:23
 * Date  : 07-ene-2015
 * 
 * Borra una pelicula
 * 
 */
require_once __DIR__.'/../src/bootstrap.php';

// Tratamos de obtener la entidad a borra mediante su ID
$pelicula = $entityManager->find('Cine\Entity\Pelicula', $_GET['id']);
if (!$pelicula) {
    throw new \Exception('Pelicula no encontrada');
}
// Marcamos el estado de la entidad como 'removed'
$entityManager->remove($pelicula);
// Persistimos cambios 
$entityManager->flush();

// Redireccionamos al inicio
header('Location: index.php');
exit;
