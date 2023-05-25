<!DOCTYPE html>
<html lang="FR">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <title>Messagerie | Mot de passe oublié</title>
     <link rel="stylesheet" href="../css/style.css">
     <link rel="icon" type="image/x-icon" href="../css/logo">
</head>

<body>
     <div class="center">
          <p class="back">⪡ <a href="/online_formapro/messagerie/chatmvc">Retour</a></p>
          <img src="../css/logo" alt="logo">
          <h1 class="header-line">Modification du mot de passe</h1>
          <div>
               <form method="post">
                    <div>
                         <input type="email" name="email" placeholder="Entrez votre email" maxlength="50" pattern="^[A-Za-z]+@{1}[A-Za-z]+.{1}[A-Za-z]{2,}$" required>
                    </div>

                    <div>
                         <!-- La fonction valid() est appelée lors de la désactivation de l'input -->
                         <input type="password" name="password" 
                         placeholder="Nouveau mot de passe" onBlur="valid()" maxlength="50" required>
                    </div>

                    <divp>
                         <!-- La fonction valid() est appelée lors de la désactivation de l'input -->
                         <input type="password" name="pswdconfirm" placeholder="Confirmez le mot de passe" maxlength="50" onBlur="valid()" required>
                         <span id="pswdCheck"></span>
                    </div>

                    <button class="margin-top" type="submit" name="change">ENREGISTRER</button>
               </form>
          </div>
     </div>

     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
     <script src="../js/main.js"></script>
     
</body>
</html>