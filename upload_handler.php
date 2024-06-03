<?php
include 'db.php';

// Ha az űrlap elküldése megtörtént
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizzük és mentjük az űrlap adatait
    $nev = $_POST['nev'];
    $nem = $_POST['nem'];
    $chip_szam = $_POST['chip_szam'];
    $fajta = $_POST['fajta'];
    $egeszseg = $_POST['egeszseg'];
    $fogak = $_POST['fogak'];
    $kor = $_POST['kor'];
    $info = $_POST['info'];
    $ivartalanitott = isset($_POST['ivartalanitott']) ? 1 : 0;

    // SQL lekérdezés előkészítése és végrehajtása az adatok beillesztésére
    $sql = "INSERT INTO dogs (nev, nem, chip_szam, fajta, egeszseg, fogak, kor, info, ivartalanitott) 
            VALUES ('$nev', '$nem', '$chip_szam', '$fajta', '$egeszseg', '$fogak', $kor, '$info', $ivartalanitott)";

    if ($conn->query($sql) === TRUE) {
        $message = "Az adatok sikeresen fel lettek töltve.";
        $message_type = "success";
    } else {
        $message = "Hiba történt az adatok feltöltése közben: " . $conn->error;
        $message_type = "error";
    }

    // Adatbázis kapcsolat lezárása
    $conn->close();

    // Átirányítás az uploads.php oldalra
    header("Location: uploads.php?message=" . urlencode($message) . "&message_type=" . urlencode($message_type));
    exit();
} else {
    // Ha nem POST kérés érkezett, átirányítás az uploads.php oldalra
    header("Location: uploads.php");
    exit();
}
?>
