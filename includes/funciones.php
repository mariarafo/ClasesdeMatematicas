<?php
 
//para ir viendo lo que estamos haciendo y detiene el resto del codigo 
function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//para identificar el ultimo elemto
function esULtimo(string $actual, string $proximo): bool {
    if($actual !== $proximo){
        return true;
    }
    return false;

}

//Funcion que revisa que el usuario este autenticado
function isAuth(): void{ //no devuelve nada 
    if(!isset($_SESSION['login'])){
        header('Location:/');

    }
}

//Funcion que revisa si es el admin
function isAdmin(): void{ //no devuelve nada 
    if(!isset($_SESSION['admin'])){
        header('Location:/');

    }
}