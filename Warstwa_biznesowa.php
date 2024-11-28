<?php

    require ("Warstwa_dostepu_do_danych.php");

    $blad_SQL='';
    $lokacja_plikow='dane_MK/';

    use Zdjecia_i_filmy;


    function wb_pobierz_zawartosc_bazy_lista(int $ilosc_elm): array{
        return wd_wykonaj_pobierz_MK($ilosc_elm);
    }

    function wb_zapisz_plik(string $nazwa): int{

        global $lokacja_plikow;
      
        if (empty($_FILES['file']['tmp_name']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            return 1; // Błąd, plik nie został załadowany poprawnie
        }

        $originalFilePath = $_FILES['file']['tmp_name']; // Tymczasowa ścieżka pliku na serwerze
        $newFileName = $nazwa;

        $destination = $lokacja_plikow . $newFileName;

        if (move_uploaded_file($originalFilePath, $destination)) {
            return 0; // Sukces, plik zapisany pomyślnie
        } else {
            return 1; // Błąd podczas zapisywania pliku
        }

    }

    function wb_zapisz_film(      
        string $nazwa,
        string $komentarz,
        string $kategoria,
        string $tresc,
        string $typ_pliku,
        string $urzadzenie,
        array $file
    ): int{

        global $lokacja_plikow;

        if(wb_sprawdz_popr_i_kompl($nazwa,$komentarz,$kategoria,
        $tresc,$typ_pliku,$urzadzenie,$file) ==1){
            return 1;
        }

        $id = wd_ustal_max_id();
        if(wb_zapisz_plik($id)==1){
            return 1;
        } 

        $referencja = $lokacja_plikow . $id;
        if(wd_wykonaj_zapisz_MK($id,$nazwa,$komentarz,$kategoria,
        $tresc,$typ_pliku,$urzadzenie,$referencja,'')==1){
            return 1;
        };

        return 0;
        

    }

    function wb_zapisz_zdjecie(Zdjecia_i_filmy $zjdecie): int{


    }



    function wb_sprawdz_popr_i_kompl(
        string $nazwa,
        string $komentarz,
        string $kategoria,
        string $tresc,
        string $typ_pliku,
        string $urzadzenie,
        array $file
    ): int {
        // 1. Validate "nazwa" (max 20 characters, required)
        if (empty($nazwa) || mb_strlen($nazwa) > 20) {
            return 1; // Invalid "nazwa"
        }
    
        // 2. Validate "komentarz" (max 200 characters, optional)
        if ( mb_strlen($komentarz) > 200) {
            return 1; // Invalid "komentarz"
        }
    
        // 3. Validate "kategoria" (max 50 characters, required)
        if (empty($kategoria) || mb_strlen($kategoria) > 50) {
            return 1; // Invalid "kategoria"
        }
    
        // 4. Validate "tresc" (optional, assumed max length of 1000 characters)
        if ( mb_strlen($tresc) > 50) {
            return 1; // Invalid "tresc"
        }
    
        if (mb_strlen($urzadzenie)>50){
            return 1;
        }

        //5
        if ( mb_strlen($typ_pliku) > 7 ) {
            return 1; // Invalid "typ_pliku"
        }
    
        // 6. Validate "file" (uploaded file required, ensure existence)
        if (empty($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK || !file_exists($file['tmp_name'])) {
            return 1; // Invalid or missing file
        }
    
        // Check if MIME type matches the file's actual content (optional)
        // $finfo = finfo_open(FILEINFO_MIME_TYPE); // Open fileinfo
        // $detectedType = finfo_file($finfo, $file['tmp_name']); // Detect MIME type
        // finfo_close($finfo);
    
    
        // 7. Validate the Polish character set (UTF-8 support)
        $polishCharsPattern = '/^[a-zA-Z0-9ąćęłńóśźżĄĆĘŁŃÓŚŹŻ ]+$/u';
        if (!preg_match($polishCharsPattern, $nazwa) || !preg_match($polishCharsPattern, $kategoria)) {
            return 1; // Invalid characters in "nazwa" or "kategoria"
        }
    
        // Validation passed
        return 0; // Success
    }
    

?>