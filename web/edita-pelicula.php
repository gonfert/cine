<?php
/*
 * Crea o edita una pelicula 
 * 
 */
 
use Cine\Entity\Pelicula;
use Cine\Entity\Etiqueta;

require_once __DIR__.'/../src/bootstrap.php';

// Recuperamos la pelicula indicada por el ID, si existe.
if (isset ($_GET['id'])) {
    $pelicula = $entityManager->find('Cine\Entity\Pelicula', $_GET['id']);
    if (!$pelicula) {
        throw new \Exception('Pelicula no encontrada');
    }
}

// Creamos o actualizamos 
if ('POST' === $_SERVER['REQUEST_METHOD']) {
    
    if (!isset ($pelicula)) {
        // Creamos nueva entidad
        $pelicula = new Pelicula();
        // La hacemos gestionable 
        $entityManager->persist($pelicula);
    }
    // Informamos la entidad
    $pelicula
        ->setTitulo($_POST['titulo'])
        ->setTituloOriginal($_POST['tituloOriginal'])
        ->setAnyo($_POST['anyo'])
        ->setDirector($_POST['director'])
    ;
    
    // Obtenemos la etiquetas
    $lasEtiquetas = [];
    foreach (explode(',', $_POST['etiquetas']) as $unaEtiqueta) {
        $nombreEtiqueta = trim($unaEtiqueta);
        $etiqueta = $entityManager->find('Cine\Entity\Etiqueta', $nombreEtiqueta);
        if (!$etiqueta) {
            $etiqueta = new Etiqueta();
            $etiqueta->setNombre($nombreEtiqueta);
        }
        $lasEtiquetas[] = $etiqueta;
    }
    
    // Eliminamos etiquetas no usadas
    foreach (array_diff($pelicula->getEtiquetas()->toArray(), $lasEtiquetas) as $etiqueta) {
        $pelicula->removeEtiqueta($etiqueta);
    }
    
    // Inserta nuevas etiquetas
    foreach (array_diff($lasEtiquetas, $pelicula->getEtiquetas()->toArray()) as $etiqueta) {
        $pelicula->addEtiqueta($etiqueta);
    }            
    
    // Persistimos la entidad
    $entityManager->flush();

    // Redirecccion al indice
    header('Location: index.php');
    exit;
}

// Titulo de la pagina
$pageTitle = isset ($pelicula) ? sprintf('Editando pelicula #%d', $pelicula->getId()) : 'Creando nueva pelicula';
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

    <form method="POST">
        <label>T&iacute;tulo</label>
        <input type="text" name="titulo" 
               value="<?=isset ($pelicula) ? $pelicula->getTitulo() : ''?>" 
               maxlength="100" required>
        <br>
        <label>T&iacute;tulo Original</label>
        <input type="text" name="tituloOriginal" 
               value="<?=isset ($pelicula) ? $pelicula->getTituloOriginal() : ''?>" 
               maxlength="100" required>
        <br>
        <label>Director</label>
        <input type="text" name="director" 
               value="<?=isset ($pelicula) ? $pelicula->getDirector() : ''?>" 
               maxlength="100" required>
        <br>
        <label>A&ntilde;o</label>
        <input type="text" name="anyo" 
               value="<?=isset ($pelicula) ? $pelicula->getAnyo() : ''?>" 
               maxlength="100" required>
        <br>
        <label>Etiquetas</label>
        <input type="text" name="etiquetas" 
               value="<?=isset ($pelicula) ? htmlspecialchars(implode(', ', $pelicula->getEtiquetas()->toArray())) : ''?>" 
               maxlength="100" required>        
        <br>
        <br>
        <input type="submit" value="Enviar">
    </form>
    
    <br>
    <a href="index.php">Volver al inicio</a>

    </body>
</html>
