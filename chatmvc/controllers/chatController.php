<?php

class chatController {
    protected $chatModel;
    protected $roomID;

    public function __construct() {
        $this->chatModel = new chatModel();

        // détermine le numéro de la chatroom actuelle
        $url = explode("/", $_GET['action']);
        $this->roomID = end($url);
    }

    public function valid_donnees($donnees) { // Fonction de nettoyage/validation des données
		$donnees = trim($donnees);
		$donnees = stripslashes($donnees);
		$donnees = htmlspecialchars($donnees);
		return $donnees;
	}

    public function chatIndex() { // Gère de la page des chatrooms

        // Lorsqu'un message est posté dans une chatroom
        if (isset($_POST['message'])) {
            $user = $this->valid_donnees($_SESSION['user_id']);
            $message = $this->valid_donnees($_POST['message']);
            $time = date('Y-m-d H:i:s');
            $color = $this->valid_donnees($_POST['color']);
            $room = $this->valid_donnees($_POST['room']);

            if (!empty($user)
            && !empty($message)
            && strlen($message) <= 100
            && preg_match("#^[A-Za-zÀ-ÿ0-9 '.!?-]+$#", $message)) {
                // Il est stocké en base de donnée dans la table "messages"
                $this->chatModel->storeMessage($user, $message, $time, $color, $room);
            }
        } 

        // A la connexion :
        // le nom de la chatroom actuelle est récupéré
        $currentRoom = $this->chatModel->getRoom($this->roomID);
        // les messages de la chatroom actuelle qui étaient enregistrés en bdd sont récupérés
        $result = $this->chatModel->getMessages($this->roomID);
        
        // Affiche la view chatroom
        require_once(ROOT . '/views/chat/chatView.php');
    }

    public function search() { // Gère la page de recherche

        // Si une recherche est effectuée via la page de recherche
        if (isset ($_POST['search'])) {
            $input = $this->valid_donnees($_POST['input']);

            if (!empty($input)
            && strlen($input) <= 50
            && preg_match("#^[A-Za-zÀ-ÿ0-9 '.!?-]+$#", $input)) {
                // une recherche des mots clefs en bdd est effectuée
                // pour sélectionner les messages les contenant
                $result = $this->chatModel->searchMessages($input);
            }
        }
        
        // Affiche la view recherche
        require_once(ROOT . '/views/chat/searchView.php');
    }

    public function logout() { // Déconnecte l'utilisateur

        if (isset ($_POST['logout'])) {
            $_SESSION = array();
            session_destroy(); // réinitialise $_SESSION
        }
    }
}