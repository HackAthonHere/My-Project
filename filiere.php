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
    <title>Document</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- <div class="header">
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
    </div> -->
    <center>
        <h1>Filieres</h1>
        <form action="" method="post">
            <center>
                <?php

if (isset($_POST["insert"])) {
      $num_filiere=$_POST["num_filiere"];
      $nom_filiere=$_POST["nom_filiere"];
      $mh=$_POST["mh"];
if (!empty($num_filiere && $nom_filiere && $mh)) {
               $insert=$pdo->prepare("INSERT INTO filiere(num_filiere,nom_filiere,mh) VALUES(:num_filiere,:nom_filiere,:mh)");
               $insert->bindParam(':num_filiere',$num_filiere);
               $insert->bindParam(':nom_filiere',$nom_filiere);
               $insert->bindParam(':mh',$mh);


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
      $num_filiere=$_POST["num_filiere"];
      $nom_filiere=$_POST["nom_filiere"];
      $mh=$_POST["mh"];
      $id=$_POST["id"];
      if (!empty($num_filiere && $nom_filiere && $mh)) {
        $update=$pdo->prepare("UPDATE filiere SET num_filiere=:num_filiere,nom_filiere=:nom_filiere,mh=:mh WHERE id=".$id);
        $update->bindParam(":num_filiere",$num_filiere);
        $update->bindParam(":nom_filiere",$nom_filiere);
        $update->bindParam(":mh",$mh);
        
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
    $delete=$pdo->prepare("DELETE FROM  filiere WHERE id=".$_POST["delete"]);

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
            $select=$pdo->prepare("SELECT * FROM filiere WHERE id=".$_POST['edite']);
            $select->execute();
            if ($select) {
                 $row=$select->fetch(PDO::FETCH_OBJ);
         echo '
        <p><input type="text" name="num_filiere" id="" value="'.$row->num_filiere.'"></p>
        <p><input type="text" name="nom_filiere" id="" value="'.$row->nom_filiere.'"></p>
        <p><input type="text" name="mh" id="" value="'.$row->mh.'"></p>
        <p><input type="hidden" name="id" id="" value="'.$row->id.'"></p>
        <td><button type="submit" name="update">update</button></td>
        <td><button type="submit" name="cancel">cancel</button></td>

            ';            
        }
         }else {
            echo '
        <p><input type="text" name="num_filiere" id="" placeholder="num_filiere"></p>
        <p><input type="text" name="nom_filiere" id="" placeholder="nom_filiere"></p>
        <p><input type="text" name="mh" id="" placeholder="mh"></p>
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
                               <th>num_filiere</th>
                               <th>nom_filiere</th>
                               <th>mh</th>
                               <th>Edit</th>
                               <th>Delete</th>               
                           </thead>
                           <tbody>
                        ';
                        $select=$pdo->prepare("SELECT * FROM filiere WHERE id=".$_POST["show_id"]);
                       $select->execute();
                         while ( $row=$select->fetch(PDO::FETCH_OBJ)) {
                         echo '
                         <tr>
                         <td>'.$row->num_filiere.'</td>
                         <td>'.$row->nom_filiere.'</td>
                         <td>'.$row->mh.'</td>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>