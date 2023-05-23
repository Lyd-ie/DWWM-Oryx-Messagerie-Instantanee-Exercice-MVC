<?php
class loginController {
    protected $loginModel;

    public function __construct() {
        $this->loginModel = new loginModel();
    }

    
    public function loginIndex() { // Gère la page de login

        // Si le bouton login n'a pas encore été activé
        if (!isset($_POST['login'])) {
            // Affiche la page de login
            require_once(ROOT . 'views/login/loginView.php');

        // Si le bouton login a été activé (tentative de connexion) 
        } else {
            // vérification que l'utilisateur existe en bdd, via loginModel()
            $id = $this->loginModel->existUser($_POST);
            
            if ($id > 0) {
                // Si l'utilisateur existe, il est redirigé vers le chat "Bienvenue"
                header('location:../chatmvc/chat/chatIndex/1');
            } else {
                // sinon il est alerté de l'échec de connexion et la page de login se recharge
                echo '<script> alert("Utilisateur inconnu, veuillez vérifier vos identifiants");
                document.location.href=""; </script>';
            }
        }
    }
    
    public function signup() { // Gère la page de création de compte

        // Si le bouton Enregistrer n'a pas encore été activé
        if (!isset($_POST['signup'])) {
            // Affiche la page de création de compte
            require_once(ROOT . '/views/login/signupView.php');
        
        // Si le bouton Enregistrer a été activé (submit du form de création de compte)
        } else {
            // création de l'utilisateur en base de donnée avec les éléments du form
            $newAccount = $this->loginModel->createUser($_POST);

            // Si l'ajout en bdd a fonctionné normalement
            if ($newAccount === TRUE) {
                // l'utilisateur est redirigé vers la page de login
                header('location:../');
            }
        }
    }

    public function forgotPassword() { // Gère la page de changement de mot de passe

        // Si le bouton Enregistrer n'a pas encore été activé
        if (!isset($_POST['change'])) {
            // Affiche la page de création de compte
            require_once(ROOT . '/views/login/forgotPasswordView.php');

        // Si le bouton Enregistré a été activé (requête de changement de mot de passe)
        } else {
            // modification du mot de passe de l'utilisateur concerné en base de donnée
            $changePassword = $this->loginModel->changePassword($_POST);

            // Si la modification a fonctionné
            if ($changePassword === TRUE) {
                // l'utilisateur est redirigé vers la page de login
                header('location:../');
            }
        }     
    }
}