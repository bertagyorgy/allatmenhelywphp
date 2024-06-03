<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $param_username);
        $param_username = $username;
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                header("location: registration.php?message=" . urlencode("Ez a felhasználónév már foglalt.") . "&message_type=error");
            } else {
                $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("ss", $param_username, $param_password);
                    $param_username = $username;
                    $param_password = password_hash($password, PASSWORD_DEFAULT);
                    if ($stmt->execute()) {
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
