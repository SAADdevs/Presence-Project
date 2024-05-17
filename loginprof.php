<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="absence.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: url('https://cdn.pixabay.com/photo/2017/10/05/10/37/paper-2818976_1280.jpg');
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            text-align: center;
        }
        .container {
            max-width: 400px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 10px 100px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h1 {
            color: #0D2C5E;
            font-size: 100px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color: #0D2C5E;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #0c2b5a;
            color: rgb(255, 255, 255);
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #d2c7fc;
        }
        form {
            width: 100%;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <div class="container">
        <form action="PrValid.php" method="post">
            <div>
                <label for="f">Nom :</label><br>
                <input type="text" name="nom" id="f" placeholder="Entre votre nom"><br>
            </div>
            <div>
                <label for="l">Prenom:</label><br>
                <input type="text" name="prenom" id="l" required placeholder="Entre votre prenom"><br>
            </div>
            <div>
                <label for="p">Password:</label><br>
                <input type="password" name="MotDePasse" id="p"><br>
            </div>
            <div>
                <input type="submit" value="submit" id="sub">
            </div>
        </form>
    </div>

    <?php
    session_start();

    if (isset($_SESSION['error_message'])) {
        echo "<p class='error-message'>" . $_SESSION['error_message'] . "</p>";
        unset($_SESSION['error_message']);
    }
    ?>
</body>
</html>
