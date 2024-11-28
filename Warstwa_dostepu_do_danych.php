<?php
    
    require('Warstwa_dostepu_do_danych_konfiguracja.php');

    


    function wd_wykonaj_pobierz_MK(int $liczba_elementów):array{

   
    }

    function wd_wykonaj_zapisz_MK(  
    int $id,
    string $nazwa,
    string $komentarz,
    string $kategoria,
    string $tresc,
    string $typ_pliku,
    string $urzadzenie,
    string $referencja,
    string $plik
    ):int{

        global $conn;

        $query = "
        INSERT INTO zdjecia_i_filmy 
        (nazwa, komentarz, kategoria, tresc, typ_pliku, urzadzenie,referencja ,plik)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

        if($plik==''){
            if ($stmt = $conn->prepare($query)) {
                // Wiązanie parametrów
                $stmt->bind_param($id, $nazwa, $komentarz, $kategoria, $tresc, $typ_pliku, $urzadzenie,$referencja,'');

                if ($stmt->execute()) {
                    // Zwracamy 0, jeśli zapis zakończył się sukcesem
                    return 0;
                } else {
                    // W przypadku błędu zwracamy kod błędu
                    return 1;
                }
        }else {
            // W przypadku błędu przygotowania zapytania////////////////////////////////////////////////////////////
            return 2;
        }
     
    }else{
        if ($stmt = $conn->prepare($query)) {
            // Wiązanie parametrów
            $stmt->bind_param($id, $nazwa, $komentarz, $kategoria, $tresc, $typ_pliku, $urzadzenie,'',$plik);

            if ($stmt->execute()) {
                // Zwracamy 0, jeśli zapis zakończył się sukcesem
                return 0;
            } else {
                // W przypadku błędu zwracamy kod błędu
                return 1;
            }
    }else {
        // W przypadku błędu przygotowania zapytania////////////////////////////////////////////////////////////
        return 2;
    }
    }
}

    function wd_ustal_max_id():int{
        global $conn;

        $query = "SELECT MAX(id_m) AS max_id FROM zdjecia_i_filmy"; // Zamień "twoja_tabela" na nazwę swojej tabeli

        $result = $conn->query($query);
    
        if ($result && $row = $result->fetch_assoc()) {
            // Pobierz maksymalne ID, jeśli istnieje, i zwróć je powiększone o 1
            return (int)$row['max_id'] + 1;
        } else {
            // Jeśli brak wyników (np. tabela jest pusta), zwracamy 1 jako pierwszy ID
            return 1;
        }
  
    }


?>