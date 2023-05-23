<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Messagerie | Signup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h3>CREER UN COMPTE</h3>
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">

                <form method="post">
                    <div class="form-group">
                        <label>Entrez votre pseudo</label>
                        <input class="form-control" type="text" name="pseudo" pattern="^[A-Za-zÀ-ÿ0-9 '-]+$" required>
                    </div>

                    <div class="form-group">
                        <label>Choisissez votre couleur</label>
                        <input class="form-control" type="text" name="color" pattern="^[A-Za-zÀ-ÿ0-9 '-]+$" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Email :</label>
                        <input class="form-control" type="email" name="email" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required>
                    </div>

                    <div class="form-group">
                        <label>Mot de passe :</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                
                    <div class="form-group">
                        <label id="mdp">Confirmez le mot de passe :</label>
                        <!-- La fonction valid() est appelée lors de la désactivation de l'input -->
                        <input class="form-control" type="password" name="pswdconfirm" onBlur="valid()" required>
                        <span id="pswdCheck"></span>
                    </div>

                    <button type="submit" name="signup" class="btn btn-info">ENREGISTRER</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script >

        // Vérifie que les deux mots de passe saisis par l'utilisateur sont identiques
        // Affiche le résultat dans un span.
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