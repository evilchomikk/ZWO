<?php
    
    require('Warstwa_dostepu_do_danych_konfiguracja.php');

    


    function wd_wykonaj_pobierz_MK(int $liczba_elementów):array{

        global $adres_ip_serwera_BD;
        global $nazwa_BD;
        global $login_BD;
        global $haslo_BD;
        echo''.$adres_ip_serwera_BD;

        $mysqli = mysql_connect($adres_ip_serwera_BD,$login_BD,$haslo_BD);
        mysql_select_db($nazwa_BD);

        $zapytanie = "SELECT * FROM zdjecia_i_filmy LIMIT ".$liczba_elementów;
        $wynik = mysql_query($zapytanie);

        mysql_close($mysqli);

        return $wynik;
    }

    function wd_wykonaj_zapisz_MK(Zdjecia_i_filmy $zjdecieLubFilm):int{

        global $adres_ip_serwera_BD;
        global $nazwa_BD;
        global $login_BD;
        global $haslo_BD;
        echo''.$adres_ip_serwera_BD;

        $mysqli = mysql_connect($adres_ip_serwera_BD,$login_BD,$haslo_BD);
        mysql_select_db($nazwa_BD);

        $zapytanie = "INSERT INTO zdjecia_i_filmy (id_m, nazwa, komentarz, kategoria, tresc,typ_pliku,urzadzenie,referencja,obraz) 
        VALUES ('".$zjdecieLubFilm->id_m."','".$zjdecieLubFilm->nazwa."','".$zjdecieLubFilm->komentarz."',
        '".$zjdecieLubFilm->kategoria."','".$zjdecieLubFilm->tresc."','".$zjdecieLubFilm->typ_pliku."','".$zjdecieLubFilm->urzadzenie."',
        '".$zjdecieLubFilm->referencja."','".$zjdecieLubFilm->obraz."')";
        $wynik = mysql_query($zapytanie);

        mysql_close($mysqli);

        if ($wynik) {
            return 0;
        } else {
            return 1;
        }
    }

    function wd_ustal_max_id():int{

        global $adres_ip_serwera_BD;
        global $nazwa_BD;
        global $login_BD;
        global $haslo_BD;
        echo''.$adres_ip_serwera_BD;

        $mysqli = mysql_connect($adres_ip_serwera_BD,$login_BD,$haslo_BD);
        mysql_select_db($nazwa_BD);

        $zapytanie = "SELECT MAX(id_m) FROM zdjecia_i_filmy";
        $wynik = mysql_query($zapytanie);

        mysql_close($mysqli);

        return $wynik;
    }


?>