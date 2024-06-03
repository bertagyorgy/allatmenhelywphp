<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Ellenőrzés és mentés az űrlapról érkező adatokból
    $id = $_POST['id'];
    $nev = $_POST['nev'];
    $nem = $_POST['nem'];
    $chip_szam = $_POST['chip_szam'];
    $fajta = $_POST['fajta'];
    $kor = $_POST['kor'];
    $info = $_POST['info'];
    $ivartalanitott = isset($_POST['ivartalanitott']) ? 1 : 0;

    // SQL lekérdezés előkészítése és végrehajtása az adatok módosítására
    $sql = "UPDATE dogs SET nev='$nev', nem='$nem', chip_szam='$chip_szam', fajta='$fajta', kor=$kor, info='$info', ivartalanitott=$ivartalanitott WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Sikeres módosítás esetén átirányítás a változások menüre (index.php)
        header("Location: changes.php");
        exit();
    } else {
        // Hiba esetén átirányítás az edit.php oldalra
        header("Location: edit.php?id=$id&message=" . urlencode("Hiba történt az adatok módosítása közben: " . $conn->error) . "&message_type=error");
        exit();
    }
} else {
    // Ha nem megfelelő kérés érkezett, átirányítás az edit.php oldalra
    header("Location: edit.php?message=" . urlencode("Nem megfelelő kérés.") . "&message_type=error");
    exit();
}

// Adatbáziskapcsolat lezárása
$conn->close();
?>
