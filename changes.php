<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buksi kutyamenhely</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body>
    <header>
        <h1>Adatok Szerkesztése</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php"><i class="fa-solid fa-house"></i> Főoldal</a></li>
            <li><a href="dogs.php"><i class="fa-solid fa-paw"></i> Örökbeadás</a></li>
            <li><a href="uploads.php"><i class="fa-solid fa-file-arrow-up"></i> Feltöltés</a></li>
            <li><a href="changes.php"><i class="fa-solid fa-table"></i> Változások</a></li>
        </ul>
    </nav>
    <div id="content" class="other-pages">
        <section id="dog-table">
            <h2>Kutyák adatai</h2>
            <table>
                <tr>
                    <th>Név</th>
                    <th>Nem</th>
                    <th>Chip szám</th>
                    <th>Fajta</th>
                    <th>Egészségi állapot</th>
                    <th>Fogak állapota</th>
                    <th>Kor</th>
                    <th>További információ</th>
                    <th>Ivartalanított</th>
                    <th>Műveletek</th>
                </tr>
                <?php
                include 'db.php';

                // Adatok lekérése az adatbázisból
                $sql = "SELECT * FROM dogs";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nev'] . "</td>";
                        echo "<td>" . $row['nem'] . "</td>";
                        echo "<td>" . $row['chip_szam'] . "</td>";
                        echo "<td>" . $row['fajta'] . "</td>";
                        echo "<td>" . $row['egeszseg'] . "</td>";
                        echo "<td>" . $row['fogak'] . "</td>";
                        echo "<td>" . $row['kor'] . "</td>";
                        echo "<td>" . $row['info'] . "</td>";
                        echo "<td>" . ($row['ivartalanitott'] ? 'Igen' : 'Nem') . "</td>";
                        echo "<td><a href='edit.php?id=" . $row['id'] . "'>Szerkesztés</a> | <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Biztosan törölni akarja ezt a rekordot?\")'>Törlés</i></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Nincsenek adatok az adatbázisban.</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </section>
    </div>
    <footer>
        <p>&copy; 2024 Buksi kutyamenhely. Minden jog fenntartva.</p>
    </footer>
</body>
</html>
