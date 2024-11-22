<?php

    require ("Warstwa_biznesowa.php");

    $form_dodaj_film_MK = '';
    $form_dodaj_zdjecie_MK='';


    function wp_dodaj_zdjecie_(){


        global $form_dodaj_zdjecie_MK;
        $zdjecie_dane = explode(',', $form_dodaj_zdjecie_MK);

        $zdjecie_dane_asoc = [
            "id_m" => $zdjecie_dane[0],
            "nazwa" => $zdjecie_dane[1],
            "komentarz" => $zdjecie_dane[2],
            "kategoria" => $zdjecie_dane[3],
            "tresc" => $zdjecie_dane[4],
            "typ_pliku" => $zdjecie_dane[5],
            "referencja" => '',
            "obraz" => $zdjecie_dane[6]
        ];

        $zdjecie = new Zdjecia_i_filmy($zdjecie_dane_asoc);

        if(wb_zapisz_zdjecie($zdjecie)==1){
            wp_wyswietl_komunikat('zapis nieudany!');
        }
    }
    
    function wp_do_dodaj_film(){
        global $form_dodaj_film_MK;
        $film_dane = explode(',', $form_dodaj_film_MK);

        $film_dane_asoc = [
            "id_m" => $film_dane[0],
            "nazwa" => $film_dane[1],
            "komentarz" => $film_dane[2],
            "kategoria" => $film_dane[3],
            "tresc" => $film_dane[4],
            "typ_pliku" => $film_dane[5],
            "referencja" => '',
            "obraz" => '',
        ];

        $film = new Zdjecia_i_filmy($film_dane_asoc);

        if(wb_zapisz_film($film)==1){
            wp_wyswietl_komunikat('zapis nieudany!');
        }
    }


    function wp_test_lista(){
        wb_pobierz_zawartosc_bazy_lista(10);
    }

    function wp_wyswietl_komunikat($komunikat) {
        echo $komunikat;
    }
    

?>