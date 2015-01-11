<?php
/*
 * Name  : index.php
 */

// Bootstrap de la aplicacion
require_once __DIR__.'/../src/bootstrap.php';

// Recuperamos el listado completo de las peliculas de la BBDD
$peliculas = $entityManager->getRepository('Cine\Entity\Pelicula')->findAll();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Introduccion a Doctrine</title>
        <link rel="stylesheet" href="css/style.css">
        <style>
            td,th {border: 1px black solid; padding: 5px}
            th {background-color: #d0d0d0}
            table {border-collapse: collapse}
        </style>
    </head>
    <body>
    <h1>Pel&iacute;culas</h1>

    <?php if (empty($peliculas)): ?>
        <p>No hay datos.</p>
    <?php else: ?>
        <table>
            <tr><th>T&iacute;tulo</th>
                <th>T&iacute;tulo Original</th><th colspan="2"></th></tr>
        <?php foreach ($peliculas as $p): ?>
            <tr>
                <td><?=$p->getTitulo()?></td>
                <td><?=$p->getTituloOriginal()?></td>
                <td><a href="edita-pelicula.php?id=<?=$p->getId()?>">Editar</a></td>
                <td><a href="borra-pelicula.php?id=<?=$p->getId()?>" 
                       onclick="return confirm('Estas seguro?')">Borrar</a></td>            
            </tr>
        <?php endforeach ?>          
        </table> 
    <?php endif ?>

    <br />
    <a href="edita-pelicula.php">Nueva pelicula</a>    
    </body>
</html>
