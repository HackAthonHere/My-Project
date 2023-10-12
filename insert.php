<?php

$host = 'localhost';
$db = 'stagiaire';
$user = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";



try {
	$pdo = new PDO($dsn, $user, $password);


  
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #434343 0%, black 100%);
        background-attachment: fixed;
        font-family: Arial, Helvetica, sans-serif;
    }

    hr {
        margin-left: 5%;
        margin-right: 5%;
    }

    a {
        text-decoration: none;
        color: #00C0FF;
        border-radius: 3px;
    }

    a:hover {
        box-shadow: 2px 2px 2px 2px #00C0FF;
    }

    header {
        margin-left: 5%;
        margin-right: 5%;
        padding: 5px;
        box-shadow: 0px 3px 0px 0px #00C0FF;
    }

    .header-div {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .header-div nav {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    nav h3 {
        margin-right: 15px;
    }

    nav input {
        width: 300px;
        height: 30px;
        border: 2px solid black;
    }

    /* end header */
    /* start footer */
    .footer {
        padding: 10px;
        margin-bottom: 2%;
        margin-top: 5%;
        margin-left: 5%;
        margin-right: 5%;
        border-top: 2px solid #00C0FF;
        border-bottom: 2px solid #00C0FF;
    }

    .footer-cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        color: white;
    }

    .footer a,
    h4 {
        text-align: center;
        color: #00C0FF;
    }

    .footer-card {
        text-align: center;
    }


    .insert {
        text-align: center;
        width: 400px;
        margin-left: 20px;
        padding: 10px;
        margin-top: 5%;
        border: 2px solid #00C0FF;
        border-radius: 5px;
    }

    .insert h2 {
        color: #00C0FF;
    }

    input {
        height: 20px;

    }

    input:hover {
        border: 2px solid #00C0FF;
    }

    h3 {
        color: red;
        font-size: 20px;
    }

    .success {
        color: green;
        font-size: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <header>
                <div class="header-div">
                    <h1><a href="">Students</a></h1>
                    <nav>
                        <h3><a href="">Home</a></h3>
                        <h3><a href="">Insert</a></h3>
                        <h3><a href="">Stagiaires</a></h3>
                        <h3><a href="">Filieres</a></h3>
                        <h3><a href="">Moduls</a></h3>
                        <h3><a href="">Help</a></h3>
                        <h3><a href="">Settings</a></h3>
                        <input type="search" name="" id="" placeholder="Search">
                    </nav>
                </div>
            </header>
        </div>
        <center>
            <div class="insert">
                <h2>Notre Stagiaire</h2>
                <form action="" method="post">
                    <p><input type="text" name="cin" id="" placeholder="Cin"></p>
                    <p><input type="text" name="nom" id="" placeholder="Nom"></p>
                    <p><input type="text" name="prenom" id="" placeholder="Prenom"></p>
                    <p><input type="text" name="num_filiere" id="" placeholder="Nomber de filiere"></p>
                    <input type="submit" value="Insert" name="show">
                </form>
                <?php 
      if (isset($_POST['show'])) {
      $cin=$_POST['cin'];
      $nom=$_POST['nom'];
      $prenom=$_POST['prenom'];
      $num_filiere=$_POST['num_filiere'];

      if (!empty($cin && $nom && $prenom && $num_filiere)) {
        $insert=$pdo->prepare("INSERT INTO stagiaire(cin,nom,prenom,num_filiere) VALUES(:cin,:nom,:prenom,:num_filiere)");
        $insert->bindParam(':cin',$cin);
        $insert->bindParam(':nom',$nom);
        $insert->bindParam(':prenom',$prenom);
        $insert->bindParam(':num_filiere',$num_filiere);

        $insert->execute();

        if ($insert->rowCount()) {
          echo '<h3 class="success">successful</h3>';
        }else{
          echo 'Faild';
        }
      } else {
        echo '<h3>Failds ar empty</h3>';
      }
  }
    ?>
            </div>
        </center>
        <div class="footer">
            <div class="footer-cards">
                <div class="footer-card">
                    <h4>Students</h4>
                    <a href="">
                        <h5>&copy;Abdelfattah 2023/2024</h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>