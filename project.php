<?php

$host = 'localhost';
$db = 'stagiaire';
$user = 'root';
$password = '';

$dsn = "mysql:host=localhost;dbname=stagiaire;charset=UTF8";


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        background: #aaa;
        background-repeat: no-repeat;
        background-size: cover;
    }

    table {
        border: 2px solid black;
        background-color: #eee;
        width: 700px;
        height: 200px;
        font-size: 30px;

    }

    td,
    th {
        border: 2px solid black;
    }

    th {
        text-align: center;
    }

    th:hover {
        background-color: white;
        color: black;
    }
    </style>
</head>

<body>
    <form action="" method="post">
        <input type="submit" value="button1" name="button1">
    </form><br>
    <?php 
		if (isset($_POST['button1'])) {
	try {
	$pdo = new PDO($dsn, $user, $password);
	
	if ($pdo) {
$stmt = $pdo->query("SELECT * FROM stagiaire");	
echo '<table>';
			echo '<tr>';
	echo '<th>Cin</th>';
		echo '<th>Nom</th>';
		echo '<th>Prenom</th>';
		echo '<th>Filiere</th>';
	echo '</tr>';
	while ($row = $stmt->fetch()) {
		echo '<tr>';
	echo '<td>';
    echo $row['cin']."<br />\n";
	echo '</td>';
	echo '<td>';
    echo $row['nom']."<br />\n";
	echo '</td>';
	echo '<td>';
    echo $row['prenom']."<br />\n";
	echo '</td>';
	echo '<td>';
    echo $row['num_filiere']."<br />\n";
	echo '</td>';
		echo '</tr>';
}}
	echo	 '</table>';
} catch (PDOException $e) {
	echo $e->getMessage();
}
}
		?>

</body>

</html>




<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("SELECT * FROM MyGuests WHERE lastname=:lastname");
  $stmt->bindParam(':lastname', $lastname);

  // insert a row
  $lastname = "Doe";
  $stmt->execute();

  // fetch the result
  $result = $stmt->fetchAll();
  print_r($result);
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>