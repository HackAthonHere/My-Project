<?php
$host = 'localhost';
$db = 'ofppt';
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
    <title>OFPPT</title>
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
    h3 {
        color: green;
    }

    .h3 {
        color: red;
    }

    form {
        margin-top: 40px;
        padding: 10px;
    }

    table,
    th,
    td {
        padding: 10px;
        width: 600px;
        border: 1px solid #00C0FF;
        color: #00C0FF;
        text-align: center;
    }

    input:hover {
        border: 2px solid #00C0FF;
    }

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

    h1 {
        color: #00C0FF;
    }
    </style>
</head>

<body>
    <div class="header">
        <header>
            <div class="header-div">
                <h1><a href="">Students</a></h1>
                <nav>
                    <h3><a href="">Home</a></h3>
                    <h3><a href="stagiaire.php">Stagiaires</a></h3>
                    <h3><a href="filiere.php">Filieres</a></h3>
                    <h3><a href="">Moduls</a></h3>
                    <h3><a href="">Help</a></h3>
                    <h3><a href="">Settings</a></h3>
                    <input type="search" name="" id="" placeholder="Search">
                </nav>
            </div>
        </header>
    </div>
    <center>
        <h1>Stagiaires</h1>
        <form action="" method="post">
            <center>
                <?php

if (isset($_POST["insert"])) {
      $cin=$_POST["cin"];
      $nom=$_POST["nom"];
      $prenom=$_POST["prenom"];
      $num_filiere=$_POST["num_filiere"];
if (!empty($cin && $nom && $prenom && $num_filiere)) {
               $insert=$pdo->prepare("INSERT INTO stagiaire_1(cin,nom,prenom,num_filiere) VALUES(:cin,:nom,:prenom,:num_filiere)");
               $insert->bindParam(':cin',$cin);
               $insert->bindParam(':nom',$nom);
               $insert->bindParam(':prenom',$prenom);
               $insert->bindParam(':num_filiere',$num_filiere);

               $insert->execute();

        if ($insert->rowCount()) {
          echo '<h3 class="success">successful</h3>';
        }else{
          echo '<h3 class="h3>Faild</h3>"';
        }
      } else {
        echo '<h3 class="h3">Failds ar empty</h3>';
      }
}

// update button

if (isset($_POST["update"])) {
      $cin=$_POST["cin"];
      $nom=$_POST["nom"];
      $prenom=$_POST["prenom"];
      $num_filiere=$_POST["num_filiere"];
      $id=$_POST["id"];
      if (!empty($cin && $nom && $prenom && $num_filiere)) {
        $update=$pdo->prepare("UPDATE stagiaire_1 SET cin=:cin,nom=:nom,prenom=:prenom,num_filiere=:num_filiere WHERE id=".$id);
        $update->bindParam(":cin",$cin);
        $update->bindParam(":nom",$nom);
        $update->bindParam(":prenom",$prenom);
        $update->bindParam(":num_filiere",$num_filiere);

        $update->execute();

        if ($update->rowCount()) {
            echo '<h3>Data update succussfull</h3>';
        }else {
            echo '<h3 class="h3">Update Failde</h3>';
        }

      }else {
        echo '<h3 class="h3">Failds are Empty</h3>';
      }
}else{

}

// Delete button

if (isset($_POST["delete"])) {
    $delete=$pdo->prepare("DELETE FROM  stagiaire_1 WHERE id=".$_POST["delete"]);

    $delete->execute();
    if ($delete->rowCount()) {
        echo '<h3>The Data is successfull Deleted</h3>';
    }else{
        echo '<h3 class="h3">The Data is not Deleted</h3>';
    }
}

?>
            </center>
            <?php
         if (isset($_POST["edite"])){
            $select=$pdo->prepare("SELECT * FROM stagiaire_1 WHERE id=".$_POST['edite']);
            $select->execute();
            if ($select) {
                 $row=$select->fetch(PDO::FETCH_OBJ);
         echo '
        <p><input type="text" name="cin" id="" value="'.$row->cin.'"></p>
        <p><input type="text" name="nom" id="" value="'.$row->nom.'"></p>
        <p><input type="text" name="prenom" id="" value="'.$row->prenom.'"></p>
        <p><input type="text" name="num_filiere" id="" value="'.$row->num_filiere.'"></p>
        <p><input type="hidden" name="id" id="" value="'.$row->id.'"></p>
        <td><button type="submit" name="update">update</button></td>
        <td><button type="submit" name="cancel">cancel</button></td>

            ';            
        }
         }else {
            echo '
        <p><input type="text" name="cin" id="" placeholder="Cin"></p>
        <p><input type="text" name="nom" id="" placeholder="Nom"></p>
        <p><input type="text" name="prenom" id="" placeholder="Prenom"></p>
        <p><input type="text" name="num_filiere" id="" placeholder="Nomber de filiere"></p>
        <input type="submit" value="Insert" name="insert"><br><br><hr>
        <input type="text" value="" name="show_id" placeholder="Enter the id to search"><br><br>
        <input type="submit" value="Show" name="show">
            ';
         }
         ?>
            <br>
            <br>
            <?php
                if (isset($_POST["show"])) {
                    if (!empty($_POST["show_id"])){
                        echo '
                        <table id="show_table">
                        <thead>
                               <th>CIN</th>
                               <th>NOM</th>
                               <th>PRENOM</th>
                               <th>NUM_FILIERE</th>
                               <th>Edit</th>
                               <th>Delete</th>               
                           </thead>
                           <tbody>
                        ';
                        $select=$pdo->prepare("SELECT * FROM stagiaire_1 WHERE id=".$_POST["show_id"]);
                       $select->execute();
                         while ( $row=$select->fetch(PDO::FETCH_OBJ)) {
                         echo '
                         <tr>
                         <td>'.$row->cin.'</td>
                         <td>'.$row->nom.'</td>
                         <td>'.$row->prenom.'</td>
                         <td>'.$row->num_filiere.'</td>
                         <td><button type="submit" value="'.$row->id.'" name="edite">Edit</button></td>
                         <td><button type="submit" value="'.$row->id.'" name="delete">Delete</button></td>
                         </td>
                         </tr>
                         ';
                        }
                    }else {
                        echo '<h3 class="h3">The Faild is empty</h3>';
                    }
                }
           ?>
            </tbody>
            </table>
        </form>
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
</body>

</html>