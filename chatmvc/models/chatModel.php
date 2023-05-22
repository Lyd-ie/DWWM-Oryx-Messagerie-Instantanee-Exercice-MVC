<?php
class chatModel {

	protected $dbh;

	public function __construct(){		
		$this->dbh = new PDO('mysql:host=localhost'.';dbname=messagerie', 'root', 'root');
	}

	public function currentUser($data){
		$userId = $data;

		$sql = "SELECT user_id, user_name FROM users WHERE user_id = :user_id";
		$query = $this->dbh->prepare($sql);
		$query->bindParam(':user_id', $userId, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetch();

		if ($result) {
			return $result['user_name'];
		} else {
			return 0;
		}
	}

	public function getCurrentUser() {
		return $this->user;
	}

	public function storeMessage($user, $message, $time, $color, $room) {
		$sql = "INSERT INTO messages (msg_text, msg_user_id, msg_date, msg_room_id, msg_color)
                VALUES (:message, :user, :date, :roomid, :color)";
      	$query = $this->dbh->prepare($sql);
      	$query ->bindParam(':message', $message, PDO::PARAM_STR);
      	$query->bindParam(':user', $user, PDO::PARAM_INT);
		$query->bindParam(':date', $time);
		$query->bindParam(':roomid', $room, PDO::PARAM_INT);
		$query->bindParam(':color', $color, PDO::PARAM_STR);
		$query->execute();
    }

	public function getRoom($roomID) {
		$sql = "SELECT * FROM rooms WHERE room_id = :roomid";
      	$query = $this->dbh->prepare($sql);
		$query->bindParam(':roomid', $roomID, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetch();

		return $result['room_name'];
	}

	public function getMessages($roomID) {
		$sql = "SELECT * FROM
					(SELECT user_name, msg_text, msg_date, msg_color FROM messages 
					JOIN users
                	ON messages.msg_user_id = users.user_id
					WHERE msg_room_id = :roomid
					ORDER BY msg_date DESC LIMIT 10)
				AS subquery
				ORDER BY msg_date ASC";
      	$query = $this->dbh->prepare($sql);
		$query->bindParam(':roomid', $roomID, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		
		return $result;		
	}

	public function searchMessages($input) {

		// error_log($input);
		$sql = "SELECT user_name, msg_text, msg_date, room_name FROM messages
				JOIN users
				ON messages.msg_user_id = users.user_id
				JOIN rooms
				ON messages.msg_room_id = rooms.room_id
				WHERE MATCH (msg_text) AGAINST (:input);";
      	$query = $this->dbh->prepare($sql);
		$query->bindParam(':input', $input, PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		
		return $result;		
	}
}