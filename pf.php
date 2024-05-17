<?php
session_start(); // Start the session if not already started
include "./connect.php";

if (isset($_POST['code'])) {
    $inputValue = $_POST['code'];
    $query = "UPDATE `prof` SET `nbrOrigine` = $inputValue WHERE `id-prof` = 1;"; // Output the query string for debugging purposes
    $result = $conn->query($query);
    if ($result == true) {
        $_SESSION["valid"] = "You chose the code $inputValue";
    } else {
        $_SESSION['valid'] = "Database error: " . $conn->error;
    }
}

if (!isset($_POST['reset_code'])) {
    
    $resetQuery = "UPDATE `prof` SET `nbrOrigine` = NULL WHERE `id-prof` = 1;";
    $resetResult = $conn->query($resetQuery);
    if ($resetResult == true) {
        $_SESSION["valid"] = "Code reset successfully!";
    } 
    else 
    {
        $_SESSION['valid'] = "Database error: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace professeur</title>
    
    <style>
        
body {
            
            font-family: Arial, sans-serif;
            background-image: url("backk.jbg"); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;;
                    margin: 0;
                    padding: 0;
                }
                h1 {
            font-weight: bold ;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-style: oblique;
            font-style: italic;
            color: #a1d1d3;
            margin-top: 20px;
            text-align: center;
            font-size: 50px;
            text-decoration: underline;
            text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.3);
            font-size:90px;
        
            
        }
        
                form {
                    background-color: #fff;
                    max-width: 400px;
                    margin: 20px auto;
                    padding: 20px;
                    border-radius: 20px;
                    box-shadow: 50px 50px 10px rgba(0, 0, 0, 0.1);
                    font-weight: bold ;
                    font-style: oblique;
                    font-style: italic;
                    display: flex;
    flex-direction: column;
 background-color: aliceblue;
    padding:10px;
    border-radius: 6px;
    box-shadow:0 0 10px black;
    width: 50%;
    border-radius: 40px;
  
}
                
        
                h2 {
                    color:blue;
                    font-size: 24px;
                    margin-bottom: 20px;
                    font-weight: bold ;

                }
        
                label {
margin-bottom: 6px;
font-size: 20px;
font-style: oblique;
text-decoration-line: underline;
}
        
                input[type="text"] {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 20px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                }
        
                input[type="submit"] {
                    background-color: #007bff;
                    border: none;
                    padding: 12px 20px;
                    border-radius: 4px;
                    cursor: pointer;
                }
        
                input[type="submit"]:hover {
            background-color: #a2c2ca;
        }
                hr {
                    font-size:50px;
                }
                #liste {
        text-align: center; 
        margin-top: 50px; 
    }
    ul{
        font-weight: bold ;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-style: oblique;
            font-style: italic;
    }
    .session-message {
            color: red; 
            font-size: 18px; 
            font-family: Arial, sans-serif; 
            margin-top: 10px; 
            text-align: center;
        }
    </style>
</head>
<body>
<h1><Marquee>Professor's space</Marquee></h1><hr>
    <h2><u>How does the code work?</u></h2>
    <ul> 
        <ol>
            <li>The teacher enters the code.</li>
            <li>The system verifies if the code entered by the teacher matches a valid code in the database.</li>
            <li>If the code matches a valid one:</li>
            <ul>
                <li>The student is marked as present.</li>
                <li>A confirmation is displayed to the teacher, indicating that the student's attendance has been successfully justified.</li>
            </ul>
            <li>If the code does not match a valid one:</li>
            <ul>
                <li>An error message is displayed to the teacher, informing them that the entered code is not valid.</li>
            </ul>
        </ol>
    </ul>
    <div id="liste">
        <form action="./AbsPre2.php" method="get">
            <input type="submit" value="Present List" name="present">
            <input type="submit" value="Absent List" name="absent">
            <input type="submit" value="Absent and Present List" name="absent_present"><br>
        </form>
    </div>
    <form method="post" id="codeForm">
    <div class="prof">
        <div>
            <label for="code">Code :</label><br>
            <input type="text" name="code" id="code" placeholder="Enter a Code"><br>
        </div>
        <div>
            <input type="submit" value="Submit" id="subm">
            <button type="button" id="resetBtn">Reset Code</button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('resetBtn').addEventListener('click', function() {
        document.getElementById('code').value = ''; // Clear the input field
    });
});
</script>


    <?php
    if (isset($_SESSION['valid'])) {
        echo "<p class='session-message'>" . $_SESSION['valid'] . "</p>";
        unset($_SESSION['valid']);
    }
    ?> 
</body>
</html>

