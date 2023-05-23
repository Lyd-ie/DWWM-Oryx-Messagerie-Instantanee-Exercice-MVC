<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Messagerie | Login</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/x-icon" href="8020086">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
</head>

<body>
  <div class="center">
    <img src="8020086" alt="logo">
    <h1 class="header-line">Connectez-vous pour discuter</h1>
    <!--Formulaire de login-->
    <div>
      <div>
        <form method="post" action="login">

          <div>
            <!-- <label>Entrez votre pseudo</label> -->
            <input class="input-text" name="pseudo" placeholder="Entrez votre pseudo" maxlength="50" pattern="^[A-Za-zÀ-ÿ0-9 '-]+$">
          </div>

          <div class="margin">
            <!-- <label>Mot de passe</label> -->
            <input type="password" name="password" placeholder="Mot de passe" maxlength="50">
            <p><a href="/online_formapro/messagerie/chatmvc/login/forgotpassword">Mot de passe oublié ?</a></p>
          </div>

          <div>
            <button type="submit" name="login" class="btn btn-info">LOGIN </button> &nbsp;&nbsp;&nbsp;
            <a href="/online_formapro/messagerie/chatmvc/login/signup">Je n'ai pas de compte</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
</body>
</html>