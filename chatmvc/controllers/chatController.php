<?php

class chatController {
    protected $chatModel;
    protected $roomID;

    public function __construct() {
        $this->chatModel = new chatModel();
        $url = explode("/", $_GET['action']);
        $this->roomID = end($url);
    }

    public function chatIndex() {   

        if (isset($_POST['message'])) {
            $user = $_SESSION['user_id'];
            $message = $_POST['message'];
            $time = date('Y-m-d H:i:s');
            $color = $_POST['color'];
            $room = $_POST['room'];
            $this->chatModel->storeMessage($user, $message, $time, $color, $room);
        } 

        $currentRoom = $this->chatModel->getRoom($this->roomID);
        $result = $this->chatModel->getMessages($this->roomID);
        
        require_once(ROOT . '/views/chat/chatView.php');
    }

    public function search() {

        if (isset ($_POST['search'])) {
            $input = $_POST['input'];
            $result = $this->chatModel->searchMessages($input);
        }
        
        require_once(ROOT . '/views/chat/searchView.php');
    }
}