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
        <h1>Örökbefogadható Kutyák</h1>
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
        <section id="search">
            <form id="search-form">
                <input type="text" id="search-input" placeholder="Keresés név alapján...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                <button type="button" id="clear-search"><i class="fa-solid fa-x"></i></button>
            </form>
        </section>
        <section id="dog-container">
            <?php
            include 'db.php';
            
            $sql = "SELECT * FROM dogs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='dog-card'>";
                    if (!empty($row["image"])) {
                        echo "<img src='uploads/" . $row["image"] . "' alt='" . $row["nev"] . "' class='dog-image'>";
                    }
                    echo "<h2>" . $row["nev"] . "</h2>";
                    echo "<p>Nem: " . $row["nem"] . "</p>";
                    echo "<p>Chip Szám: " . $row["chip_szam"] . "</p>";
                    echo "<p>Faj: " . $row["fajta"] . "</p>";
                    echo "<p>Egészség: " . $row["egeszseg"] . "</p>";
                    echo "<p>Fogak: " . $row["fogak"] . "</p>";
                    echo "<p>Kor: " . $row["kor"] . " év</p>";
                    echo "<p>Leírás: " . $row["info"] . "</p>";
                    echo "<p>Ivartalanított: " . ($row["ivartalanitott"] ? 'Igen' : 'Nem') . "</p>";
                    echo "</div>";
                }
            } else {
                echo "Nincsenek kutyák az adatbázisban.";
            }

            $conn->close();
            ?>
        </section>
    </div>
    <footer>
        <p>&copy; 2024 Buksi kutyamenhely. Minden jog fenntartva.</p>
    </footer>
    <script>
        // Első lépésként megvárjuk, amíg az összes elem betöltődik a DOM-ba
        document.addEventListener("DOMContentLoaded", function () {
            // Az elemek kiválasztása az id alapján
            var searchForm = document.getElementById("search-form");
            var searchInput = document.getElementById("search-input");
            var clearSearch = document.getElementById("clear-search");
            var dogCards = document.querySelectorAll(".dog-card"); // Minden kutyakártya elem kiválasztása

            // Űrlap elküldésekor indítsuk el a keresést
            searchForm.addEventListener("submit", function (event) {
                event.preventDefault(); // Ne küldje el az űrlapot
                search();
            });

            // Keresés törlése gombra kattintáskor törölje a keresési mező tartalmát és jelenítse meg az eredeti listát
            clearSearch.addEventListener("click", function () {
                searchInput.value = ""; // Törölje a keresési mező tartalmát
                search(); // Újra megjelenítjük az eredeti listát
            });

            // Keresés funkció
            function search() {
                var filter = searchInput.value.toUpperCase(); // Konvertáljuk a keresési kifejezést nagybetűssé

                dogCards.forEach(function(card) {
                    var name = card.querySelector("h2").innerText.toUpperCase(); // A kártya címe (kutya neve)

                    // Ellenőrizze, hogy a kutya neve tartalmazza-e a keresési szót
                    if (name.indexOf(filter) > -1) {
                        card.style.display = ""; // Megjeleníti a kártyát
                    } else {
                        card.style.display = "none"; // Rejtse el a kártyát
                    }
                });
            }
        });
    </script>
</body>
</html>
