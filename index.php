<?php
session_start();

if (empty($_SESSION['id']))
{
  header('location:connexion.php');
}

$bdd = new PDO("mysql:host=localhost;dbname=forum;charset=utf8", 'root', 'root');

$req = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
$req->execute(array($_SESSION['id']));

$userinfo = $req->fetch();

if(!empty($_POST['submit'])){
    if(!empty($_POST['message'])){
        $message = htmlspecialchars($_POST['message']);

        $ins = $bdd->prepare('INSERT INTO message(contenu,id_utilisateur) VALUES (?, ?)');
        $ins->execute(array($message,$userinfo['id']));

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

<a href='deconnexion.php'><button type="button" class="btn btn-danger">Se déconnecter</button></a>


<!-- Default form contact -->

<div class="container-fluid">
    <div class="container2">
        <form method="POST" >

    <p class="h4 mb-4" style="margin-left:230px;margin-top:-60px; padding-bottom:60px;">FORUM</p>

    <div class="md-form mt-0">
        <input type="text" id="message" name="message" class="form-control">
        <label for="message">Message</label>
    </div>

    <form method="POST">

    <!-- Send button -->
    <input style="padding-left:0px;padding-right:150px;margin-left:140px;margin-right:60px;" type="submit" class="btn btn-info btn-block" id="submit" name="submit" value="Envoyer">

</form>
    </div>
</div>

<!-- Default form contact -->




<?php



$req = $bdd->prepare('SELECT * FROM message WHERE id != ? ORDER BY id DESC');
$req->execute(array(0));


  while ($m = $req->fetch())
  {

    $requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
    $requser->execute(array($m['id_utilisateur']));
    $user = $requser->fetch();

  ?>
<div>

<div class="chat-message">

  <ul class="list-unstyledchat">
    
    <li>
      <div class="chat-body white p-3 z-depth-1">
        <div class="header">
          <strong><?= $user['pseudo'] ?></strong>
          <small class="pull-right text-muted"> a envoyé <i class="far fa-envelope"></i></small>
        </div>
        <hr class="w-100">
        <p class="mb-0">
        <?= $m['contenu'] ?>
        </p>
      </div>
    </li>
  </ul>

</div>
</div>
</div>
</div>
</div>


    <?php
  }
  ?>



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