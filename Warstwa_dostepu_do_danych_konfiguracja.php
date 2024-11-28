<?php  
    $adres_ip_serwera_BD='localhost:3306';
    $nazwa_BD='mm_MK';
    $login_BD='root';
    $haslo_BD;

    $conn = new mysqli($adres_ip_serwera_BD, $login_BD, $haslo_BD, $nazwa_BD);

    if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
    }


?>