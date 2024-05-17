<?php
session_start(); 
include './connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : ""; 
    $codeApoge = isset($_POST['CodeApoge']) ? trim($_POST['CodeApoge']) : ""; 
    $motDePasse = isset($_POST['MotDePasse']) ? trim($_POST['MotDePasse']) : "";

    if (empty($nom) || empty($prenom) || empty($codeApoge) || empty($motDePasse)) {
        $_SESSION['error_message'] = "Please fill in all required fields.";
        header("Location: loginET.php");
        exit();
    }
    $stmt = $conn->prepare("SELECT * FROM etudiant WHERE code = ? AND mot_password = ?");
    $stmt->bind_param("ss", $codeApoge, $motDePasse);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        $_SESSION['error_message'] = "Database error: " . $conn->error;
        header("Location: loginET.php");
        exit();
    }

    if ($result->num_rows > 0) {
        $_SESSION['codeApoge'] = $codeApoge;
        header("Location: verification.html");
        exit(); 
    } else {
        $_SESSION['error_message'] = "Invalid credentials!";
        header("Location: loginET.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
