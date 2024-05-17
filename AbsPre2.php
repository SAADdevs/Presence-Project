<?php
include "./connect.php";

if (isset($_GET['present'])) {
    $sql = "SELECT e.code, e.Nome, e.Prenom, s.Matier, s.date, e.present
            FROM etudiant e, prof p, seance s
            WHERE e.Seance = s.`id-seance` AND s.`id-prof` = p.`id-prof`
            AND e.present = 'oui';";

    echo "<div class='container'>";
    echo "<h1>Liste des étudiants présents</h1><br>";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='styled-table'>";
        echo "<thead>
                <tr>
                    <th>NOM DE L'ÉTUDIANT</th>
                    <th>PRÉNOM DE L'ÉTUDIANT</th>
                    <th>MATIÈRE</th>
                    <th>CODE</th>
                    <th>PRÉSENT</th>
                </tr>
              </thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Prenom"] . "</td>";
            echo "<td>" . $row["Matier"] . "</td>";
            echo "<td>" . $row["code"] . "</td>";
            echo "<td>" . $row["present"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo '<br><a class="back-link" href="./profHome.php">Retour à la page du professeur</a>';
    } else {
        $_SESSION["valid"] = "THERE IS NO STUDENT";
    }
    echo "</div>";
}

if (isset($_GET['absent_present'])) {
    $sql = "SELECT e.code, e.Nome, e.Prenom, s.Matier, s.date, e.present
            FROM etudiant e, prof p, seance s
            WHERE e.Seance = s.`id-seance` AND s.`id-prof` = p.`id-prof`;";

    echo "<div class='container'>";
    echo "<h1>Liste des étudiants présents et absents</h1><br>";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='styled-table'>";
        echo "<thead>
                <tr>
                    <th>NOM DE L'ÉTUDIANT</th>
                    <th>PRÉNOM DE L'ÉTUDIANT</th>
                    <th>MATIÈRE</th>
                    <th>CODE</th>
                    <th>PRÉSENT</th>
                </tr>
              </thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Prenom"] . "</td>";
            echo "<td>" . $row["Matier"] . "</td>";
            echo "<td>" . $row["code"] . "</td>";
            echo "<td>" . $row["present"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        $_SESSION["valid"] = "THERE IS NO STUDENT";
    }
    echo '<br><a class="back-link" href="./profHome.php">Retour à la page du professeur</a>';
    echo "</div>";
}

if (isset($_GET['absent'])) {
    $sql = "SELECT e.code, e.Nome, e.Prenom, s.Matier, s.date, e.present
            FROM etudiant e, prof p, seance s
            WHERE e.Seance = s.`id-seance` AND s.`id-prof` = p.`id-prof`
            AND e.present = 'non';";

    echo "<div class='container'>";
    echo "<h1>Liste des étudiants absents</h1><br>";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='styled-table'>";
        echo "<thead>
                <tr>
                    <th>NOM DE L'ÉTUDIANT</th>
                    <th>PRÉNOM DE L'ÉTUDIANT</th>
                    <th>MATIÈRE</th>
                    <th>CODE</th>
                    <th>PRÉSENT</th>
                </tr>
              </thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Prenom"] . "</td>";
            echo "<td>" . $row["Matier"] . "</td>";
            echo "<td>" . $row["code"] . "</td>";
            echo "<td>" . $row["present"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo '<br><a class="back-link" href="./profHome.php">Retour à la page du professeur</a>';
    } else {
        $_SESSION["valid"] = "THERE IS NO STUDENT";
    }
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            color: #042584;
            margin-bottom: 20px;
        }

        table.styled-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.styled-table th, table.styled-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table.styled-table th {
            background-color: #042584;
            color: white;
        }

        table.styled-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table.styled-table tr:hover {
            background-color: #ddd;
        }

        .back-link {
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #042584;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 200px;
            margin: 20px auto;
        }

        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

</body>
</html>

