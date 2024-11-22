<?php

    require ("Warstwa_dostepu_do_danych.php");

    $blad_SQL='';
    $lokacja_plikow='/dane_MK/';

    use Zdjecia_i_filmy;


    function wb_pobierz_zawartosc_bazy_lista(int $ilosc_elm): array{
        return wd_wykonaj_pobierz_MK($ilosc_elm);
    }

    function wb_zapisz_plik(string $nazwa): int{
        global $lokacja_plikow;

        $sciezka = $lokacja_plikow . basename($nazwa);
    
        if (move_uploaded_file($_FILES['plik']['tmp_name'], $sciezka)) {
            return 0; // Success
        } else {
            return 1; // Failure
        }
    }
    function wb_zapisz_film(Zdjecia_i_filmy $film): int{
        global $lokacja_plikow;


        if(wb_sprawdz_popr_i_kompl(zjdecieLubFilm: $film)== 0){
            $max_id=wd_ustal_max_id()+ 1;
            if(wb_zapisz_plik($max_id)==0){

                $film->referencja = $lokacja_plikow . $max_id;

                if(wd_wykonaj_zapisz_MK($film)==0){
                    return 0;
                };
            }
        }
        return 1;
    }

    function wb_zapisz_zdjecie(Zdjecia_i_filmy $zjdecie): int{
        
        if(wb_sprawdz_popr_i_kompl($zjdecie)==0){
            $max_id=wd_ustal_max_id()+1;
            $zjdecie->id_m=$max_id;

            if(wd_wykonaj_zapisz_MK($zjdecie)==0){
                return 0;
            }
        }
        return 1;
    }



    function wb_sprawdz_popr_i_kompl(Zdjecia_i_filmy $zjdecieLubFilm):int{
        if ($zjdecieLubFilm->nazwa=='' || $zjdecieLubFilm->kategoria==''){
            return 1;
        }
        return 0;
    }
?>