<?php
session_start();
?>

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
        <h1>Buksi kutyamenhely</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php"><i class="fa-solid fa-house"></i> Főoldal</a></li>
            <?php if (isset($_SESSION["username"])) : ?>
                <!-- Megjeleníthető menüpontok a bejelentkezett felhasználó számára -->
                <li><a href="dogs.php"><i class="fa-solid fa-paw"></i> Örökbeadás</a></li>
                <li><a href="uploads.php"><i class="fa-solid fa-file-arrow-up"></i> Feltöltés</a></li>
                <li><a href="changes.php"><i class="fa-solid fa-table"></i> Változások</a></li>
                <li><a href="logout.php" onclick="return confirm('Biztosan ki szeretne lépni?')">Kijelentkezés</a></li>
            <?php else : ?>
                <!-- Megjeleníthető menüpontok a bejelentkezetlen felhasználó számára -->
                <li><a href="login.php" class="login-button">Bejelentkezés</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div id="content">
        <section class="welcome">
            <h2><i class="fa-solid fa-paw"></i> Üdvözlünk <i class="fa-solid fa-paw"></i></h2>
            <p>Állatmenhelyünk szeretettel vár minden látogatót, aki megismerné kis barátainkat.</p>
            <p>Kérjük, látogass el a "Örökbeadás" oldalra, hogy megismerhesd jelenlegi lakóinkat.</p>
        </section>

   		<img src="images/dogs.jpg">
		<img src="images/dogs2.jpg">
		<img src="images/dogs3.jpg">
		<img src="images/dogs4.jpg">
		<img src="images/dogs5.jpg">
		<img src="images/dogs6.jpg">
		<section class="welcome">
            <h2>Legújabb kutyusunk:</h2>
			<h2>Lassie</h2>
			<img src="images/dogs7.jpg">
            <p>Lassie egy 2 éves okos, intelligens szuka. Imád a természetben lenni. Gazdája meghalt így Lassie egy új családot keres most.</p>
			<p>Gyerekek mellett is jól megvan, szintúgy a macskákkal is.</p>
            <p>Ha Lassie felkeltette az érdeklődésed, kérjük érdeklődj telefonon vagy személyesen.</p>
        </section>
		<section class="welcome">
		<h2>Merre keress minket?</h2>
        <!-- Google Maps Iframe -->
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345095173!2d144.95592831531672!3d-37.81720997975144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf5777dd4e4c66d8!2sFederation%20Square!5e0!3m2!1sen!2sau!4v1571538231042!5m2!1sen!2sau" 
				width="600" 
				height="450" 
				frameborder="0"
				border-radius="5"
				style="border:0;" 
				allowfullscreen="" 
				aria-hidden="false" 
				tabindex="0">
			</iframe>
		</section>
		<section class="welcome">
		<h2>Kutyatréning</h2>
        <!-- Google Maps Iframe -->
		<section class="welcome">
		    <iframe 
				width="600" 
				height="450" 
				src="https://www.youtube.com/embed/pt5MDc22RPY" 
				frameborder="0" 
				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
				allowfullscreen>
			</iframe>
		</section>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Kapcsolat</h3>
                <p><i class="fa-solid fa-envelope"></i> info@buksi-kutyaorokbeadas.hu</p>
                <p><i class="fa-solid fa-phone"></i> +36 30 123 4567</p>
            </div>
            <div class="footer-section">
                <h3>Kövess minket</h3>
                <a href="#"><i class="fa-brands fa-facebook"></i> Facebook</a>
                <a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i> Twitter</a>
            </div>
            <div class="footer-section">
                <h3>Helyszín</h3>
                <p>1234 Budapest, Kutyaközi út 5.</p>
            </div>
        </div>
        <p>&copy; 2024 Buksi kutyamenhely. Minden jog fenntartva.</p>
    </footer>
</body>
</html>
