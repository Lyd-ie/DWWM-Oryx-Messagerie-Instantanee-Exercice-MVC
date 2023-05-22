<?php

class loginController
{
    protected $loginModel;

    public function __construct() {
        $this->loginModel = new loginModel();
    }

    public function loginIndex() {
        if (isset($_POST['login'])) {
            $id = $this->loginModel->existUser($_POST);

            if ($id > 0) {
                header('location:../chatmvc/chat/chatIndex/1');
            }
            
        } else {
            require_once(ROOT . 'views/login/loginView.php');
        }

        require_once(ROOT . 'views/login/loginView.php');
    }

    public function signup() {
        if (isset($_POST['signup'])) {
            $newAccount = $this->loginModel->createUser($_POST);

            if ($newAccount === TRUE) {
                header('location:../');
            }
            
        } else {
            require_once(ROOT . '/views/login/signupView.php');
        }
    }

    public function forgotPassword()
    {

        if (isset($_POST['change'])) {
            $changePassword = $this->loginModel->changePassword($_POST);

            if ($changePassword === TRUE) {
                header('location:../');
            }
            else {
                error_log('oups');
            }
        }
        // header('location:../login/loginIndex');

        require_once(ROOT . '/views/login/forgotPasswordView.php');
    }
}
