<?php
session_start(); 

include "./connect.php";
 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["code"])) {
    $enteredCode = $_POST["code"];
    
    if (isset($_SESSION['codeEntered']) && $_SESSION['codeEntered'] === true) {
        $_SESSION["error"] = "You have already entered the code.";
    } else {
        $sql = "SELECT `nbrOrigine` FROM `prof` WHERE `id-prof` = 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $constantNumber = isset($row['nbrOrigine']) ? $row['nbrOrigine'] : null;

        if ($enteredCode == $constantNumber) {
            $codeApoge = isset($_SESSION['codeApoge']) ? $_SESSION['codeApoge'] : "";
            if (!empty($codeApoge)) {
                $sqlCheckPresence = "SELECT `present` FROM `etudiant` WHERE `code` = '$codeApoge'";
                $resultCheckPresence = $conn->query($sqlCheckPresence);
                $rowPresence = $resultCheckPresence->fetch_assoc();
                $presenceStatus = isset($rowPresence['present']) ? $rowPresence['present'] : null;
                if ($presenceStatus === 'non') {
                    $sqlUpdatePresent = "UPDATE `etudiant` SET `present`='oui', `nbr_prs`=`nbr_prs`+1 WHERE `code` = '$codeApoge'";
                } else {
                    $sqlUpdatePresent = "UPDATE `etudiant` SET `present`='non', `nbr_abs`=`nbr_abs`+1 WHERE `code` = '$codeApoge'";
                }

                if ($conn->query($sqlUpdatePresent) === TRUE) {
                    $_SESSION["message"] = "Your status has been updated.";
                    $_SESSION['codeEntered'] = true;
                } else {
                    $_SESSION["error"] = "Error updating status: " . $conn->error;
                }
            } else {
                $_SESSION["error"] = "Code Apoge is not set in session.";
            }
        } else {
            $_SESSION["error"] = "Incorrect code entered.";
        }
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de présence</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background:url('https://cdn.pixabay.com/photo/2017/10/05/10/37/paper-2818976_1280.jpg')
        }

        .container {
            max-width: 600px;
            margin: 0 auto; 
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #0D2C5E;
            font-style: italic; 
        }

        form {
            text-align: center;
        }

        label {
            font-weight: bold;
            color: #0D2C5E;
        }

        input[type="text"] {
            padding: 8px;
            display: block;
            margin: 10px auto 0; 
            width: 50%; 
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: width 0.3s, background-color 0.3s;
            
        }

        input[type="text"]:focus {
            width: 70%; 
            background-color: #f9f9f9;
        }

        button[type="submit"] {
            background-color: #0d2c5e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-top: 30px;
        }

        button[type="submit"]:hover {
            background-color: green;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }

        .con {
            margin-top: 8%;
        }

        .msg {
            color: red;
            margin-top: 20px;
            text-align: center;
            font-family: 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body>
    <h1>Entrer le code pour verifier votre presence</h1>
    <?php
    if (isset($_SESSION["message"])) {
        echo '<div class="message">' . $_SESSION["message"] . '</div>';
        unset($_SESSION["message"]); 
    } elseif (isset($_SESSION["error"])) {
        echo '<div class="msg">' . $_SESSION["error"] . '</div>';
        unset($_SESSION["error"]); 
    }
    ?>

    <form method="post" >
        <label for="code">Entrez le code :</label>
        <input type="text" id="code" name="code">
        <button type="submit">Soumettre le code</button>
    </form>
</body>
</html>
