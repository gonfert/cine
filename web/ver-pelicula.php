<?php
/*
 * Name  : ver-pelicula.php
 * 
 */

use Cine\Entity\Comentario;

require_once __DIR__.'/../src/bootstrap.php';

// Recuperamos la pelicula indicada por el ID, si existe.
//$pelicula = $entityManager->find('Cine\Entity\Pelicula', $_GET['id']);
//
// Recuperamos la pelicula (con sus comentarios) indicada por el ID, si existe.
$pelicula = $entityManager->getRepository('Cine\Entity\Pelicula')->findConComentarios($_GET['id']);
if (!$pelicula) {
    throw new \Exception('Pelicula no encontrada');
}

// Añadimos un nuevo comentario
if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $comentario = new Comentario();
    $comentario
        ->setTexto($_POST['texto'])
        ->setFecha(new \DateTime())
        ->setPelicula($pelicula);

    $entityManager->persist($comentario);
    // Persistimos la entidad
    $entityManager->flush();

    // Redirecccion a esta página
    header(sprintf('Location: ver-pelicula.php?id=%d', $pelicula->getId()));
    exit;
}

// Titulo de la pagina
$pageTitle = $pelicula->getTitulo();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Introduccion a Doctrine - <?=$pageTitle?></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
    <h1><?=$pageTitle?></h1>
    
    <p>T&iacute;tulo Original: <strong><?=$pelicula->getTituloOriginal()?></strong></p>
    <p>Director: <strong><?=$pelicula->getDirector()?></strong></p>    
    <p>A&ntilde;o: <strong><?=$pelicula->getAnyo()?></strong></p>    
    
    <?php foreach($pelicula->getComentarios() as $c): ?>
    <blockquote>
        <p>
            <cite>&quot;<?=$c->getTexto()?>&quot;</cite><br>
            <?=$c->getFecha()->format('Y-m-d H:i:s')?>
        </p>
        <a href="borrar-comentario.php?id=<?=$c->getId()?>"
           onclick="return confirm('Estas seguro?')">Borrar comentario</a>
    </blockquote>
    <?php endforeach ?>
        
    <form method="POST">
        <h4>A&ntilde;ada un nuevo Comentario</h4>
        <label>Comentario</label><br>
        <textarea name="texto" cols="60" rows="5"></textarea>
        <br>
        <input type="submit" value="Enviar">
    </form>    
    <br>
    <a href="index.php">Volver al inicio</a>

    </body>
</html>

