<?php
class chatModel {

	protected $dbh;

	public function __construct(){		
		$this->dbh = new PDO('mysql:host=localhost'.';dbname=messagerie', 'root', 'root');
	}

	public function storeMessage($user, $message, $time, $color, $room) { // Insère les messages envoyés par les utilisateurs en base de donnée
		// Requête d'insertion en base de donnée
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

	public function getRoom($roomID) { // Sélectionne en bdd les informations correspondant au numéro de la chatroom actuelle
		// Requête de recherche
		$sql = "SELECT * FROM rooms WHERE room_id = :roomid";
      	$query = $this->dbh->prepare($sql);
		$query->bindParam(':roomid', $roomID, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetch();

		// Renvoie le nom de la chatroom actuelle
		return $result['room_name'];
	}

	public function getMessages($roomID) { // Récupère les messages figurant en bdd selon le numéro de la chatroom actuelle
		
		// Effectue une subrequête pour sélectionner les 10 derniers messages de la chatroom, ordre du plus récent au plus ancien
		// Sélectionne l'entièreté de la subrequête et la restitue dans l'ordre du plus ancien message au plus récent
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
		
		// Retourne tous les résultats sous la forme d'un tableau d'objets
		return $result;		
	}

	public function searchMessages($input) { // Effectue une recherche en bdd selon le(s) mot(s) clé(s) de $input

		// Requête de recherche joignant 3 tables afin de restituer aussi les noms des rooms et utilisateurs concernés
		$sql = "SELECT user_name, msg_text, msg_date, msg_color, room_name, room_id FROM messages
				JOIN users
				ON messages.msg_user_id = users.user_id
				JOIN rooms
				ON messages.msg_room_id = rooms.room_id
				WHERE MATCH (msg_text) AGAINST (:input);";
      	$query = $this->dbh->prepare($sql);
		$query->bindParam(':input', $input, PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		
		// Retourne tous les résutlats sous la forme d'un tableau d'objets
		return $result;		
	}
}