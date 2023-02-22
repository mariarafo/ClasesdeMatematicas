<?php

$db = mysqli_connect($_ENV['DB_HOST'],
                     $_ENV['DB_USER'],
                     $_ENV['DB_PASS'],
                     $_ENV['DB_BD']
                    ); //al final va el nombre de la base de datos que estamos conectadno
$db->set_charset("utf8");


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
