<?php
// Kapcsolódás az adatbázishoz
include 'db.php';

// Üres változók inicializálása
$username = $password = $confirm_password = '';
$username_err = $password_err = $confirm_password_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Űrlapadatok feldolgozása
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Felhasználónév ellenőrzése, hogy már létezik-e
    $sql = "SELECT id FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $param_username);
        $param_username = $username;
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                header("location: login.php?message=" . urlencode("Ez a felhasználónév már foglalt.") . "&message_type=error");
            } else {
                // Felhasználónév beillesztése az adatbázisba
                $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("ss", $param_username, $param_password);
                    $param_username = $username;
                    $param_password = password_hash($password, PASSWORD_DEFAULT);
                    if ($stmt->execute()) {
                        // Sikeres regisztráció, átirányítás a bejelentkező oldalra
                        header("location: login.php?message=" . urlencode("Sikeres regisztráció. Jelentkezz be itt.") . "&message_type=success");
                    } else {
                        echo "Valami hiba történt. Kérlek, próbáld újra később.";
                    }
                    $stmt->close();
                }
            }
        } else {
            echo "Valami hiba történt. Kérlek, próbáld újra később.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Regisztráció</h2>
        <p>Kérlek, töltsd ki a regisztrációs űrlapot.</p>
        <!-- Hibaüzenetek megjelenítése -->
        <div class="error-message">
            <?php echo (!empty($username_err)) ? $username_err : ''; ?>
            <?php echo (!empty($password_err)) ? $password_err : ''; ?>
            <?php echo (!empty($confirm_password_err)) ? $confirm_password_err : ''; ?>
        </div>
        <!-- Űrlap -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Felhasználónév</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó megerősítése</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Regisztráció">
            </div>
            <p>Már van fiókod? <a href="login.php">Jelentkezz be itt</a>.</p>
        </form>
    </div>
</body>
</html>
