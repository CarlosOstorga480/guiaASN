<?php

require_once "conexion.php";

$sql = "SELECT ID_ESTUDIANTE, NOMBRE, MATERIA, CARNE, IMAGEN
        FROM dbo.ESTUDIANTES";

$resultado = sqlsrv_query($conn, $sql);

if ($resultado === false) {

    echo "<p style='color:red;'>Error al realizar la consulta.</p>";

    die(print_r(sqlsrv_errors(), true));
}

echo "<table>";

echo "<tr>";
echo "<th>ID</th>";
echo "<th>Nombre</th>";
echo "<th>Materia</th>";
echo "<th>Carné</th>";
echo "<th>Imagen</th>";
echo "</tr>";


while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {

    echo "<tr>";

    echo "<td>";
    echo $fila["ID_ESTUDIANTE"];
    echo "</td>";

    echo "<td>";
    echo htmlspecialchars($fila["NOMBRE"]);
    echo "</td>";

    echo "<td>";
    echo htmlspecialchars($fila["MATERIA"]);
    echo "</td>";

    echo "<td>";
    echo htmlspecialchars($fila["CARNE"]);
    echo "</td>";

    echo "<td>";

    if (!empty($fila["IMAGEN"])) {

        echo "<img src='" .
             htmlspecialchars($fila["IMAGEN"]) .
             "' width='80' height='80'>";

    } else {

        echo "Sin imagen";

    }

    echo "</td>";

    echo "</tr>";
}

echo "</table>";

sqlsrv_free_stmt($resultado);
sqlsrv_close($conn);

?>
