<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            header("location: index.php");
                        } else {
                            header("location: login.php?message=" . urlencode("Hibás jelszó!") . "&message_type=error");
                        }
                    }
                } else {
                    header("location: registration.php");
                }
            } else {
                echo "Hiba történt. Kérlek, próbáld újra később.";
            }
            $stmt->close();
        }
    }

    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    header("location: registration.php");
                } else {
                    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("ss", $param_username, $param_password);
                        $param_username = $username;
                        $param_password = password_hash($password, PASSWORD_DEFAULT);
                        if ($stmt->execute()) {
                            header("location: login.php");
                        } else {
                            echo "Hiba történt. Kérlek, próbáld újra később.";
                        }
                        $stmt->close();
                    }
                }
            } else {
                echo "Hiba történt. Kérlek, próbáld újra később.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>
