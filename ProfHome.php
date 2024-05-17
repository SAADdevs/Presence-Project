<?php
session_start(); 
include "./connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['code'])) {
        $inputValue = trim($_POST['code']);
        $stmt = $conn->prepare("UPDATE `prof` SET `nbrOrigine` = ? WHERE `id-prof` = 1");
        $stmt->bind_param("i", $inputValue);

        if ($stmt->execute()) {
            $_SESSION["valid"] = "You chose the code $inputValue";
        } else {
            $_SESSION['valid'] = "Database error: " . $conn->error;
        }

        $stmt->close();
    } elseif (isset($_POST['reset'])) {
        // Reset button logic
        $stmt = $conn->prepare("UPDATE `prof` SET `nbrOrigine` = NULL WHERE `id-prof` = 1");

        if ($stmt->execute()) {
            $_SESSION["valid"] = "Code reset successfully!";
        } else {
            $_SESSION['valid'] = "Database error: " . $conn->error;
        }

        $stmt->close();
    }
    $conn->close();
    header("Location: profHome.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profess.css">
    <title>Espace professeur</title>
</head>
<body>
    <h1><marquee>Espace professeur</marquee></h1><hr>
    <h2><u>Comment fonctionne le code ?</u></h2>
    <ul> 
        <li>Le professeur saisit le code.</li>
        <li>Le système vérifie si le code saisi par le professeur correspond à un code validé dans la base de données.</li>
        <li>Si le code correspond à le code validé</li>
        <ul>
            <li>L'étudient est marqué comme présent.</li>
            <li>Une confirmation s'affiche à l'intention du professeur, indiquant que la présence de l'étudiant a été justifiée avec succès.</li>
        </ul>
        <li>Si le code ne correspond pas au code validé:</li>
        <ul>
            <li>Un message d'erreur s'affiche à l'intention de l'enseignant, l'informant que le code saisi n'est pas valide.</li>
        </ul>
    </ul>
    <div id="liste">
        <form action="./AbsPre2.php" method="get">
            <input type="submit" value="Liste de présence" name="present">
            <input type="submit" value="Liste de absence" name="absent">
            <input type="submit" value="Liste de présence et absence" name="absent_present"><br>
        </form>
    </div>
    <form action="#" method="post">
        <div class="prof">
            <div>
                <label for="code">Code :</label><br>
                <input type="text" name="code" id="code" placeholder="Entrer un Code" required><br>
            </div>
            <div>
                <input type="submit" value="Submit" id="subm">
            </div>
        </div>
    </form>
   
    <form action="#" method="post">
        <input type="submit" name="reset" value="Reset Code">
    </form>
    
    <?php
    if (isset($_SESSION['valid'])) {
        echo "<p class='session-message'>" . $_SESSION['valid'] . "</p>";
        unset($_SESSION['valid']);
    }
    ?> 
</body>
</html>
