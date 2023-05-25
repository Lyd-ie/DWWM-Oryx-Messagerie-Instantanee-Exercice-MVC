<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Messagerie | Inscription</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/x-icon" href="../css/logo">
</head>

<body>
    <div class="up">
        <p class="back">⪡ <a href="/online_formapro/messagerie/chatmvc">Retour</a></p>
        <img src="../css/logo" alt="logo">
        <h3>CREER UN COMPTE</h3>
        <div>
            <form method="post">
                <div>
                    <input name="pseudo" placeholder="Entrez votre pseudo" pattern="^[A-Za-zÀ-ÿ0-9 '-]+$" required>
                </div>
                
                <div>
                    <input type="email" name="email" placeholder="Entrez votre email" pattern="^[\w-]+@([\w-]+)+[\w-]{2,4}$" required>
                </div>

                <div>
                    <!-- La fonction valid() est appelée lors de la désactivation de l'input -->
                    <input type="password" name="password" placeholder="Mot de passe" maxlength="50" onBlur="valid()" required>
                </div>
            
                <div>
                    <!-- La fonction valid() est appelée lors de la désactivation de l'input -->
                    <input type="password" name="pswdconfirm" onBlur="valid()" placeholder="Confirmez le mot de passe" maxlength="50" required>
                    <span id="pswdCheck"></span>
                </div>

                <button class="margin-top" type="submit" name="signup"> ENREGISTRER </button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="../js/main.js"></script> 
</body>
</html>