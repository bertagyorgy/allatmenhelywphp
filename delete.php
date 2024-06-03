<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Törlési lekérdezés végrehajtása
    $sql = "DELETE FROM dogs WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Sikeres törlés esetén visszairányítás a changes.php oldalra
        header("Location: changes.php");
        exit();
    } else {
        // Hibaüzenet, ha valami probléma történt a törlés során
        echo "Hiba: " . $conn->error;
    }
} else {
    // Hibaüzenet, ha nem megfelelő kérés érkezett
    echo "Hiba: Nem megfelelő kérés.";
}

// Adatbáziskapcsolat lezárása
$conn->close();
?>
