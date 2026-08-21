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

    <title>Actividad Práctica 2</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
        }

        header {
            background-color: #0078d4;
            color: white;
            text-align: center;
            padding: 25px;
        }

        .contenedor {
            width: 80%;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #0078d4;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }

    </style>

</head>

<body>

<header>

    <h1>ACTIVIDAD PRÁCTICA 2</h1>

    <p>Estudiantes almacenados en Azure SQL Database</p>

</header>


<div class="contenedor">

    <h2>Lista de estudiantes</h2>

    <table>

        <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th>Materia</th>
            <th>Carné</th>
            <th>Imagen</th>

        </tr>

        <?php

        while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

        ?>

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

        <?php

        }

        ?>

    </table>

</div>

</body>

</html>

<?php

sqlsrv_free_stmt($resultado);
sqlsrv_close($conn);

?>
