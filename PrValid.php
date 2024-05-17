<?php
session_start();
include './connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : "";
    $motDePasse = isset($_POST['MotDePasse']) ? trim($_POST['MotDePasse']) : "";

    if (empty($nom) || empty($prenom) || empty($motDePasse)) {
        $_SESSION['error_message'] = "Please fill in all required fields.";
        header("Location: loginprof.php");
        exit();
    }

    // Assuming the correct column names are firstname, lastname, and password
    $sql = "SELECT * FROM prof WHERE nome = ? AND prenom = ? AND mot_pass = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $nom, $prenom, $motDePasse);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            $_SESSION['error_message'] = "Database error: " . $conn->error;
            header("Location: loginprof.php");
            exit();
        }

        if ($result->num_rows > 0) {
            header("Location: profHome.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Invalid credentials!";
            header("Location: loginprof.php");
            exit();
        }

        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Failed to prepare statement: " . $conn->error;
        header("Location: loginprof.php");
        exit();
    }

    $conn->close();
} else {
    $_SESSION['error_message'] = "Invalid request method.";
    header("Location: loginprof.php");
    exit();
}
?>
