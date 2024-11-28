
<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Form - Zdjecia i Filmy</title>
        </head>
        <body>
            <form action="wp_dodaj_film_MK()" method="POST" enctype="multipart/form-data">
                <!-- ID (hidden or auto-generated in backend) -->
                <input type="hidden" name="id_m" value="">
        
                <!-- Nazwa -->
                <label for="nazwa">Nazwa (max 20 characters):</label>
                <input type="text" id="nazwa" name="nazwa" maxlength="20" required>
                <br><br>
        
                <!-- Komentarz -->
                <label for="komentarz">Komentarz (max 200 characters):</label>
                <textarea id="komentarz" name="komentarz" maxlength="200" rows="4"></textarea>
                <br><br>
        
                <!-- Kategoria -->
                <label for="kategoria">Kategoria (max 50 characters):</label>
                <input type="text" id="kategoria" name="kategoria" maxlength="50" required>
                <br><br>
        
                <!-- Tresc -->
                <label for="tresc">Treść:</label>
                <textarea id="tresc" name="tresc" rows="4"></textarea>
                <br><br>
        
                <!-- Typ Pliku -->
                <label for="typ_pliku">Typ Pliku:</label>
                <input type="text" id="typ_pliku" name="typ_pliku">
                <br><br>
        
                <!-- Urzadzenie -->
                <label for="urzadzenie">Urządzenie:</label>
                <input type="text" id="urzadzenie" name="urzadzenie">
                <br><br>
        

        
                <!-- file -->
                <label for="file">Film (Upload File):</label>
                <input type="file" id="file" name="file" accept="image/*,video/*" required>
                <br><br>
        
                <button type="submit">Submit</button>
            </form>
        </body>
        </html>;


        <?php
        require ("Warstwa_biznesowa.php");
        require ("Warstwa_prezentacji.php");
        function wp_dodaj_film_MK(): void {
            // Check if the form data exists
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Retrieve form data
                $nazwa = $_POST['nazwa'];
                $komentarz = $_POST['komentarz'];
                $kategoria = $_POST['kategoria'];
                $tresc = $_POST['tresc'];
                $typ_pliku = $_POST['typ_pliku'];
                $urzadzenie = $_POST['urzadzenie'];
                $file = $_FILES['file'];

                if(wb_zapisz_film($nazwa,$komentarz,$kategoria,$tresc,$typ_pliku,$urzadzenie,$file) ==0){
                    header("Location: test_lista.php");
                }else{
                    wp_wyswietl_komunikat("Błąd zapisu filmu");
                }
            }
        }

        // Trigger the function if form is submitted
        if (isset($_POST['submit_form'])) {
            wp_dodaj_film_MK();
        }
    ?>