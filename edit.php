<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Adatok lekérése az adatbázisból az adott id alapján
    $sql = "SELECT * FROM dogs WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kutya szerkesztése</title>
    <link rel="stylesheet" href="edit.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/font-awesome.min.css">
</head>
<body>
    <header>
        <h1>Kutya szerkesztése</h1>
    </header>
    <div id="content">
        <section id="edit-form">
            <h2>Kutya szerkesztése</h2>
            <form action="edit_handler.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="nev">Név:</label><br>
                <input type="text" id="nev" name="nev" value="<?php echo $row['nev']; ?>" required><br>
                
                <label for="nem">Nem:</label><br>
                <select id="nem" name="nem" required>
                    <option value="Hím" <?php if($row['nem'] == 'Hím') echo 'selected'; ?>>Hím</option>
                    <option value="Nőstény" <?php if($row['nem'] == 'Nőstény') echo 'selected'; ?>>Nőstény</option>
                </select><br>
                
                <label for="chip_szam">Chip szám:</label><br>
				<input type="text" id="chip_szam" name="chip_szam" value="<?php echo $row['chip_szam']; ?>"><br>

				<label for="fajta">Fajta:</label><br>
				<input type="text" id="fajta" name="fajta" value="<?php echo $row['fajta']; ?>"><br>

				<label for="egeszseg">Egészségi állapot:</label><br>
				<input type="text" id="egeszseg" name="egeszseg" value="<?php echo $row['egeszseg']; ?>"><br>

				<label for="fogak">Fogak állapota:</label><br>
				<input type="text" id="fogak" name="fogak" value="<?php echo $row['fogak']; ?>"><br>

				<label for="kor">Kor:</label><br>
				<input type="text" id="kor" name="kor" value="<?php echo $row['kor']; ?>"><br>

				<label for="info">További információ:</label><br>
				<textarea id="info" name="info"><?php echo $row['info']; ?></textarea><br>

				<label for="ivartalanitott">Ivartalanított:</label>
				<input type="checkbox" id="ivartalanitott" name="ivartalanitott" <?php if($row['ivartalanitott'] == 1) echo 'checked'; ?>><br>
                
                <input type="submit" name="submit" value="Mentés">
            </form>
        </section>
    </div>
</body>
</html>
<?php
    } else {
        // Hibaüzenet, ha nincs találat az id alapján
        echo "Hiba: Nincs találat az adatbázisban az adott azonosítóval.";
    }
} else {
    // Hibaüzenet, ha nem megfelelő kérés érkezett
    echo "Hiba: Nem megfelelő kérés.";
}

// Adatbáziskapcsolat lezárása
$conn->close();
?>
