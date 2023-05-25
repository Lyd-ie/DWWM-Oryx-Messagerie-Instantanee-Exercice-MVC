<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Messagerie | Connexion</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/x-icon" href="css/logo">
</head>

<body>
  <div class="center">
    <img src="css/logo" alt="logo">
    <h1>Connectez-vous pour discuter</h1>
    <!--Formulaire de login-->
    <div>
      <form method="post" action="login">
        <div>
          <input name="pseudo" placeholder="Entrez votre pseudo" maxlength="50" pattern="^[A-Za-zÀ-ÿ0-9 '-]+$" required>
        </div>

        <div>
          <input type="password" name="password" placeholder="Mot de passe" maxlength="50" required>
          <p><a href="/online_formapro/messagerie/chatmvc/login/forgotpassword">Mot de passe oublié ?</a></p>
        </div>

        <div>
          <button class="margin-top" type="submit" name="login">LOGIN </button> &nbsp;&nbsp;&nbsp;
          <a href="/online_formapro/messagerie/chatmvc/login/signup">Je n'ai pas de compte</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
</body>
</html>