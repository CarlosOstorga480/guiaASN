<?php

require_once "conexion.php";

$sql = "SELECT ID_ESTUDIANTE, NOMBRE, MATERIA, CARNE, IMAGEN
        FROM dbo.ESTUDIANTES";

$resultado = sqlsrv_query($conn, $sql);

if ($resultado === false) {
    die("Error en la consulta:<br><pre>" . print_r(sqlsrv_errors(), true) . "</pre>");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #0078d4;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

    </style>

</head>

<body>

<table>

    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Materia</th>
        <th>Carné</th>
        <th>Imagen</th>
    </tr>

    <?php while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) { ?>

        <tr>

            <td>
                <?php echo $fila["ID_ESTUDIANTE"]; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($fila["NOMBRE"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($fila["MATERIA"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($fila["CARNE"]); ?>
            </td>

            <td>

                <?php if (!empty($fila["IMAGEN"])) { ?>

                    <img src="<?php echo htmlspecialchars($fila["IMAGEN"]); ?>">

                <?php } else { ?>

                    Sin imagen

                <?php } ?>

            </td>

        </tr>

    <?php } ?>

</table>

</body>
</html>

<?php

sqlsrv_free_stmt($resultado);
sqlsrv_close($conn);

?>
