<?php 

session_start();

$bdd = new PDO("mysql:host=localhost;dbname=forum;charset=utf8", 'root', 'root');

if (!empty($_POST['submit'])){
    if(!empty($_POST['mail'] && !empty($_POST['mdp']))){
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = htmlspecialchars(sha1($_POST['mdp']));

        $conn = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = ? && mdp = ?');
        $conn->execute(array($mail, $mdp));

        $nb_con = $conn->rowcount();

        if ($nb_con == 1){

            $userinfo = $conn->fetch();

            $_SESSION['id'] = $userinfo['id'];

            header('location:index.php');
        }
        else{
            $error = 'Identifiants ou mdp incorrects';
        }
    }
    else{
        $error = 'Veuillez compléter les champs';
    }
}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Forum de Thierry</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

<style>
.top-50
{
  margin-top: 50px;
}
.bottom-50
{
  margin-bottom: 50px;
}
</style>


</head>

<body>

<!-- DEBUT DU PROJET-->

<div class="containter-fluid">
  <div class="container">
      <div class="col-md-6">


<!-- Material form login -->
<div class="card">

  <h5 class="card-header info-color white-text text-center py-4">
    <strong>Connexion</strong>
  </h5>

  <!--Card content-->
  <div class="card-body px-lg-5 pt-0">

    <!-- Form -->
    <form method="POST" class="text-center" style="color: #757575;">

      <!-- Email -->
      <div class="md-form">
        <input type="text" id="mail" name="mail" class="form-control">
        <label for="mail">E-mail</label>
      </div>
  
      <!-- Password -->
      <div class="md-form">
        <input type="password" id="mdp" name="mdp" class="form-control">
        <label for="mdp">Mot de passe</label>
      </div>


      <!-- Sign in button -->
      <input class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" id="submit" name="submit" value="Se connecter">

      <!-- Register -->
      <p>Toujours pas membre ?
        <a href='inscription.php'>Inscription</a>
      </p>


    </form>
    <!-- Form -->

  </div>

</div>
<!-- Material form login -->


<?php

if (isset($error))
{
?>
  <div class="alert alert-danger" role="alert">
    <?= $error ?>
  </div>
  <?php
}
?>

        </div>

    </div>
</div>


<!-- /FIN DU PROJET-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.js"></script>
</body>

</html>