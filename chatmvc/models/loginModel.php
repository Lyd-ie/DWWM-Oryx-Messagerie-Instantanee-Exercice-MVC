<?php
class loginModel {

	protected $dbh;

	public function __construct(){		
		$this->dbh = new PDO('mysql:host=localhost'.';dbname=messagerie', 'root', 'root');
	}

	// Fonction de nettoyage/validation des données
	public function valid_donnees($donnees) {
		$donnees = trim($donnees);
		$donnees = stripslashes($donnees);
		$donnees = htmlspecialchars($donnees);
		// $donnees = !empty($donnees);
		return $donnees;
	}

	public function existUser($data){
		$pseudo = $this->valid_donnees($data['pseudo']);
		$cleanedPassword = $this->valid_donnees($data['password']);
		$password = password_hash($cleanedPassword, PASSWORD_DEFAULT);

		// error_log("Password ".$password);

		if (!empty($password)
		&& strlen($cleanedPassword) <= 150
		&& !empty($pseudo)
		&& strlen($pseudo) <= 50
		&& preg_match("#^[A-Za-zÀ-ÿ0-9 '-]+$#", $pseudo)) {

			$sql = "SELECT user_id, user_name, user_password FROM users WHERE user_name = :user_name";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(':user_name', $pseudo, PDO::PARAM_STR);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);

			if (!empty($result) && password_verify($cleanedPassword, $result['user_password'])
			) {
				$_SESSION = $result;
				return $result['user_id'];
			} else {
				error_log('trouve paaas ' . $result['user_password'] . " " . $cleanedPassword);
				return 0;
			}
		}
	}

	public function createUser($data) {
		$pseudo = $this->valid_donnees($data['pseudo']);
		$email = $this->valid_donnees($data['email']);
		$cleanedPassword = $this->valid_donnees($data['password']);
		$password = password_hash($cleanedPassword, PASSWORD_DEFAULT);

		if (!empty($password)
		&& strlen($cleanedPassword) <= 150
		&& !empty($pseudo)
		&& strlen($pseudo) <= 50
		&& preg_match("#^[A-Za-zÀ-ÿ0-9 '-]+$#", $pseudo)) {

			$sql = "INSERT INTO users (user_name, user_password, user_email)
					VALUES (:name, :password, :email)";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(':name', $pseudo, PDO::PARAM_STR);
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->bindParam(':email', $email, PDO::PARAM_STR);
			
			if ($query->execute() && $query->rowCount() > 0) {
				return TRUE;
			}
		}
	}

	public function changePassword($data) {
		$email = $this->valid_donnees($data['email']);
		$cleanedPassword = $this->valid_donnees($data['password']);
		$password = password_hash($cleanedPassword, PASSWORD_DEFAULT);

		if (!empty($password)
		&& strlen($cleanedPassword) <= 150
		&& !empty($email)) {

			$sql = "UPDATE users SET user_password = :password WHERE user_email = :email";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->bindParam(':email', $email, PDO::PARAM_STR);

			if ($query->execute() && $query->rowCount() > 0) {
				return TRUE;
			}
		}
	}
}