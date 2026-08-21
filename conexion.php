<?php

$serverName = "sql-tilin.database.windows.net";

$connectionOptions = array(
    "Database" => "BD-BENITO",
    "Uid" => "adminsql",
    "PWD" => "mVqivAdd1234",
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die("Error al conectar con Azure SQL.");
}

?>
