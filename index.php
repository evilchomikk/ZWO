<?php
require 'Warstwa_biznesowa.php';

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['add_photo'])) {
        $form_dodaj_zdjecie_MK = $_POST['photo_data'];
        wp_dodaj_zdjecie_();
    }

    if (isset($_POST['add_video'])) {
        $form_dodaj_film_MK = $_POST['video_data'];
        wp_do_dodaj_film();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container, .list-container {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-container h2, .list-container h2 {
            margin-bottom: 15px;
        }
        .form-container input, .form-container textarea, .form-container button {
            display: block;
            width: 100%;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Gallery Management</h1>

    <div class="form-container">
        <h2>Add a Photo</h2>
        <form method="POST">
            <textarea name="photo_data" placeholder="Photo data (comma-separated values)" required></textarea>
            <button type="submit" name="add_photo">Add Photo</button>
        </form>
    </div>

    <div class="form-container">
        <h2>Add a Video</h2>
        <form method="POST">
            <textarea name="video_data" placeholder="Video data (comma-separated values)" required></textarea>
            <button type="submit" name="add_video">Add Video</button>
        </form>
    </div>

    <div class="list-container">
        <h2>Photo and Video List</h2>
        <ul>
            <?php
            $items = wb_pobierz_zawartosc_bazy_lista(10);
            foreach ($items as $item) {
                echo "<li>{$item['id_m']}: {$item['nazwa']} - {$item['kategoria']}</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
