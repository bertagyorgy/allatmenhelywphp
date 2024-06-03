<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buksi kutyamenhely</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- Egyéni stílusok az uploads.php-hoz -->
    <style>
        /* CSS stílusok */
    </style>
</head>
<body>
    <header>
        <h1>Kutyák Feltöltése</h1>
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
        <section id="upload-form">
            <h2>Új kutya hozzáadása</h2>
            <form action="upload_handler.php" method="post">
                <label for="nev">Név:</label><br>
                <input type="text" id="nev" name="nev" required><br>
                
                <label for="nem">Nem:</label><br>
                <select id="nem" name="nem" required>
                    <option value="Hím">Hím</option>
                    <option value="Nőstény">Nőstény</option>
                </select><br>
                
                <label for="chip_szam">Chip szám:</label><br>
                <input type="text" id="chip_szam" name="chip_szam" required><br>
                
                <label for="fajta">Fajta:</label><br>
                <input type="text" id="fajta" name="fajta" required><br>
                
                <label for="egeszseg">Egészségi állapot:</label><br>
                <textarea id="egeszseg" name="egeszseg" rows="3"></textarea><br>
                
                <label for="fogak">Fogak állapota:</label><br>
                <textarea id="fogak" name="fogak" rows="3"></textarea><br>
                
                <label for="kor">Kor:</label><br>
                <input type="number" id="kor" name="kor" required><br>
                
                <label for="info">További információ:</label><br>
                <textarea id="info" name="info" rows="5"></textarea><br>
                
                <label for="ivartalanitott">Ivartalanított:</label>
                <input type="checkbox" id="ivartalanitott" name="ivartalanitott"><br>
                
                <input type="submit" value="Küldés">
            </form>
            <?php
            // Megjeleníti a sikeres vagy sikertelen üzenetet
            if (isset($_GET['message']) && isset($_GET['message_type'])) {
                $message = $_GET['message'];
                $message_type = $_GET['message_type'];
                echo '<div class="message ' . $message_type . '">' . $message . '</div>';
            }
            ?>
        </section>
    </div>
    <footer>
        <p>&copy; 2024 Buksi kutyamenhely. Minden jog fenntartva.</p>
    </footer>
</body>
</html>
