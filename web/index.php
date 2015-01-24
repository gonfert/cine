<?php
/*
 * Name  : index.php
 * 
 */

// Bootstrap de la aplicacion
require_once __DIR__.'/../src/bootstrap.php';

// Recuperamos el listado completo de las peliculas de la BBDD
//$peliculas = $entityManager->getRepository('Cine\Entity\Pelicula')->findAll();

// Obtenoms el repositorio de la entidad
$repositorio = $entityManager->getRepository('Cine\Entity\Pelicula');
// Si nos especifican etiquetas filtramos, de lo contrario, mostramos todo.
// Ojo, que esto nos devuelve un array de arrays
if (isset($_GET['tags'])) {
    $resultados = $repositorio->findTeniendoEtiquetas(explode(',', $_GET['tags']));
} else {
    $resultados = $repositorio->findConNumComentarios();
}

// Funcion para mostrar etiquetas como enlaces
function muestraEtiquetas( $etiquetas )
{
    $retVal = '';
    foreach($etiquetas as $e){
        $retVal .= '<a href="index.php?tags='.urlencode($e).'">'.htmlspecialchars($e).'</a> ';
    } 
    return $retVal;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Introduccion a Doctrine</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1>Pel&iacute;culas</h1>

    <?php if (empty($resultados)): ?>
        <p>No hay datos.</p>
    <?php else: ?>
        <table>
            <tr><th>T&iacute;tulo</th>
                <th>T&iacute;tulo Original</th>
                <th>Etiquetas</th><th colspan="2"></th></tr>
        <?php foreach ($resultados as $res): 
                $p = $res[0]; // Pelicula
                $c = $res[1]; // Contador
        ?>
            <tr>
                <td><a href="ver-pelicula.php?id=<?php echo $p->getId()?>"><?php echo $p->getTitulo()?></a></td>
                <td><?php echo $p->getTituloOriginal()?></td>
                <td>
                    <small>
                        <?php echo muestraEtiquetas($p->getEtiquetas()); ?><br>
                        <?php if ($c == 0): ?>
                        No hay comenatrios.
                        <?php else: ?>
                        <?php echo $c; ?> comentario(s).
                        <?php endif ?>                    
                    </small>                    
                </td>
                <td><a href="edita-pelicula.php?id=<?php echo $p->getId()?>">Editar</a></td>
                <td><a href="borra-pelicula.php?id=<?php echo $p->getId()?>" 
                       onclick="return confirm('Estas seguro?')">Borrar</a></td>            
            </tr>
        <?php endforeach ?>          
        </table> 
    <?php endif ?>

    <br />
    <a href="edita-pelicula.php">Nueva pelicula</a>    
    </body>
</html>
