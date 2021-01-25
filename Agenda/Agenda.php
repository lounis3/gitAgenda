<?php

$agenda = $_POST ['agenda'] ?? array();

$nuevoNombre = filter_input(INPUT_POST, "nombre");
$nuevoTelefono = filter_input(INPUT_POST, "telefono");


$agenda[$nuevoNombre]=$nuevoTelefono;

if (isset($nuevoNombre) && strlen($nuevoNombre)==0) {
    echo "<div class='warning'>";
    $msj =  "Datos de Acceso obligatorios";
    echo "</div>";
}

$nombre= filter_input(INPUT_POST, 'nombre');
if ($nombre) {
    echo '<div class="warning">';
    echo '  No hay registros en la agenda.';
    echo '</div>';
}

function borrar($agenda) {
    unset($agenda);
}

$existe = false;
$size = count($_POST["nombre"]);

for ($i = 0;$i < $size; $i++) {
    $nombre = $_POST["nombre"][$i];
    $telefono = $_POST["telefono"][$i];

    if ($nombre == $nuevoNombre) { //Si existe el nombre
        $existe = true;
        if (strlen($nuevoTelefono)==0) {
            $nombre = null;
            $telefono = null;
        } else {
            $telefono = $nuevoTelefono;
        }
    }

    $existeTel = false;
    if ($telefono == $nuevoTelefono) { //Si existe el telefono
        $existeTel = true;
        if (strlen($nuevoNombre)==0) {
            $nombre = null;
            $telefono = null;
        } else {
            $nombre = $nuevoNombre;
        }
    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./estilos.css" type="text/css">
    <title> Agenda de contactos</title>
</head>

<body>

<!-- Formulario -->
<fieldset>
    <legend>Nuevo Contacto</legend>
    <form action="" method="POST"><br />
        <label for="nombre">
            Nombre: <input type="text" name="nombre" minlength="3"/>
        </label><br />
        <label for="telefono">
            Telefono: <input type="text" name="telefono" pattern="[0-9]{9}" size="9" />
        </label><br />
        <input type="submit" value="Añadir Contacto" name="Enviar" />
        <input type="submit" value="Eliminar Contactos" name="Enviar" onclick="<?= borrar($agenda) ?>"/>
        <?php

        foreach ($agenda as $nombre => $telefono) {
            echo "<input type=hidden name='agenda[$nombre]' value ='$telefono'>";
            echo '<table>';
            echo "<tr>";
            echo '<th> NOMBRE </th>';
            echo '<th>TELÉFONO</th>';
            echo "</tr>";
            echo "<tr>";
            echo '<td>' .$nombre. '</td>';
            echo '<td>' .$telefono. '</td>';
            echo "</tr>";
            echo '</table>';
        }


        ?>
    </form>
</fieldset>

</body>
</html>
