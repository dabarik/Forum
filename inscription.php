<?php
session_start();

$bdd = new PDO("mysql:host=localhost;dbname=forum;charset=utf8", 'root', 'root');

if (!empty($_POST['submit'])){
    if(!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && (($_POST['mdp']) == ($_POST['mdp1'])))
    {

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = htmlspecialchars(sha1($_POST['mdp']));

        $ins = $bdd->prepare('INSERT INTO utilisateur (pseudo, mail, mdp) VALUES (?, ?, ?)');
        $ins->execute(array($pseudo, $mail, $mdp));

        header('location:connexion.php');
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


<div class="container-fluid">
    <div class="container1">
        <div class="row">
            <div class="col-md-6">
<!-- Material form register -->
<div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>S'inscrire</strong>
    </h5>

            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">

                <!-- Form -->
                <form method="POST" class="text-center" style="color: #757575;">

                

                    <div class="form-row">
                        <div class="col">
                <div class="md-form" style="margin-top:30px;">
                        <input type="text" id="pseudo" name="pseudo" class="form-control" aria-describedby="materialRegisterFormPhoneHelpBlock">
                        <label for="pseudo">Pseudo</label> 
                    </div>  

                    <!-- E-mail -->
                    <div class="md-form mt-0">
                        <input type="text" id="mail" name="mail" class="form-control">
                        <label for="mail">E-mail</label>
                    </div>

                    <!-- Password -->
                    <div class="md-form">
                        <input type="password" id="mdp" name="mdp" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                        <label for="mdp">Mot de passe</label>
                    </div>

                    
                    <div class="md-form" style="margin-bottom:30px;">
                        <input type="password" id="mdp1" name="mdp1" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                        <label for="mdp1">Confirmation de votre mot de passe</label>
                    </div>
                    

                    <input id="submit" name="submit" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" value="Créer un compte">
    
                    <hr>

                
                </form>
                <!-- Form -->

    </div>

</div>
<!-- Material form register -->
</div>
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