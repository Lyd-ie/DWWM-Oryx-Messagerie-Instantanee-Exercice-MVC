<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Messagerie | Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- GOOGLE FONT -->
    <!-- link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' / -->
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <h3>CREER UN COMPTE</h3>
            </div>
        </div>
        <!--On affiche le formulaire de creation de compte-->
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 offset-md-3">
                <form method="post">
                    <div class="form-group">
                        <label>Entrez votre pseudo</label>
                        <input type="text" name="pseudo" pattern="^[A-Za-zÀ-ÿ0-9 '-]+$" required>
                    </div>

                    <div class="form-group">
                        <label>Choisissez votre couleur</label>
                        <input type="text" name="color" pattern="^[A-Za-zÀ-ÿ0-9 '-]+$" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Email :</label>
                        <input type="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Mot de passe :</label>
                        <input type="password" name="password" required>
                    </div>
                
                    <div class="form-group">
                        <label id="mdp">Confirmez le mot de passe :</label>
                        <input type="password" name="pswdconfirm" onBlur="valid()" required>
                        <span id="pswdCheck"></span>
                    </div>

                    <button type="submit" name="signup" class="btn btn-info">ENREGISTRER</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>

        // On cree une fonction valid() sans paramètre qui désactive le bouton "enregistrer" si les mots de passe saisis dans le formulaire sont différents
        function valid() {
            let password = document.querySelector("input[name='password']");
            let checkPassword = document.querySelector("input[name='pswdconfirm']");
            let submitButton = document.querySelector("button[name='signup']");
            let pswdMsg = document.getElementById("pswdCheck");

            if (password.value == checkPassword.value) {
                submitButton.disabled = false;
                pswdMsg.innerHTML = "&nbsp;Mots de passe identiques";
                pswdMsg.style.fontWeight = "800";
                pswdMsg.style.color = "green";
            }
            else {
                submitButton.disabled = true;
                pswdMsg.innerHTML = "&nbsp;Mots de passe différents";
                pswdMsg.style.fontWeight = "800";
                pswdMsg.style.color = "red";
            }
        }
    </script> 
</body>
</html>