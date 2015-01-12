<?php
/*
 * Name  : borrar-comentario.php
 * 
 */

require_once __DIR__ . '/../src/bootstrap.php';

$comentario = $entityManager->find('Blog\Entity\Comentaro', $_GET['id']);

if (!$comentario) {
    throw new \Exception('Comentario no encontrado');
}

// Borramos la entidad y guardamos cambios
$entityManager->remove($comentario);
$entityManager->flush();

// Volvemos a la pagina de la pelicula
header(sprintf('Location: ver-pelicula.php?id=%d', $comentario->getPelicula()->getId()));
exit;
