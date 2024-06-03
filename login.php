<?php
session_start();
include 'db.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Felhasználó ellenőrzése
    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Bejelentkezés sikeres
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Hibás jelszó.";
        }
    } else {
        $error_message = "Nincs ilyen felhasználónév.";
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Bejelentkezés</h2>
        <?php if (!empty($error_message)) : ?>
            <div class="error-message error">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="username">Felhasználónév:</label>
            <input type="text" id="username" name="username" required><br>
            
            <label for="password">Jelszó:</label>
            <input type="password" id="password" name="password" required><br>
            
            <input type="submit" value="Bejelentkezés">
        </form>
        <p><a href="registration.php">Regisztráció</a></p>
    </div>
</body>
</html>
