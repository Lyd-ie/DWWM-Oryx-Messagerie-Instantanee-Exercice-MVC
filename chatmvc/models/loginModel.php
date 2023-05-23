<?php
class loginModel {

	protected $dbh;

	public function __construct(){		
		$this->dbh = new PDO('mysql:host=localhost'.';dbname=messagerie', 'root', 'root');
	}

	public function valid_donnees($donnees) { // Fonction de nettoyage/validation des données
		$donnees = trim($donnees);
		$donnees = stripslashes($donnees);
		$donnees = htmlspecialchars($donnees);
		return $donnees;
	}

	public function existUser($data){ // Effectue une recherche en bdd dans la table users

		$pseudo = $this->valid_donnees($data['pseudo']);
		$cleanedPassword = $this->valid_donnees($data['password']);
		$password = password_hash($cleanedPassword, PASSWORD_DEFAULT);

		// Sécurisation de la recherche
		if (!empty($password)
		&& strlen($cleanedPassword) <= 50
		&& !empty($pseudo)
		&& strlen($pseudo) <= 50
		&& preg_match("#^[A-Za-zÀ-ÿ0-9 '-]+$#", $pseudo)) {

			// Sélectionne id, pseudo et mot de passe de la table users
			$sql = "SELECT user_id, user_name, user_password FROM users WHERE user_name = :user_name";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(':user_name', $pseudo, PDO::PARAM_STR);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);

			// Si un résultat est obtenu et que les mots de passe matchent
			if (!empty($result) && password_verify($cleanedPassword, $result['user_password'])
			) {
				// Stocke le résultat dans $_SESSION
				$_SESSION = $result;
				// Retourne l'id de l'utilisateur en base de donnée
				return $result['user_id'];
			} else {
				// Sinon retourne 0;
				return 0;
			}
		}
	}

	public function createUser($data) { // Effectue une insertion en bdd dans la table users

		$pseudo = $this->valid_donnees($data['pseudo']);
		$email = $this->valid_donnees($data['email']);
		$cleanedPassword = $this->valid_donnees($data['password']);
		$password = password_hash($cleanedPassword, PASSWORD_DEFAULT);

		// Sécurisation de la requête
		if (!empty($password)
		&& strlen($cleanedPassword) <= 50
		&& !empty($pseudo)
		&& strlen($pseudo) <= 50
		&& preg_match("#^[A-Za-zÀ-ÿ0-9 '-]+$#", $pseudo)
		&& preg_match("#^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$#", $email)) {

			// Requête d'insertion en bdd
			$sql = "INSERT INTO users (user_name, user_password, user_email)
					VALUES (:name, :password, :email)";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(':name', $pseudo, PDO::PARAM_STR);
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->bindParam(':email', $email, PDO::PARAM_STR);
			
			// Si la requête a fonctionné et créé au moins 1 row, return TRUE
			if ($query->execute() && $query->rowCount() > 0) {
				return TRUE;
			}
		}
	}

	public function changePassword($data) { // Modifie le mot de passe dans la table users en bdd

		$email = $this->valid_donnees($data['email']);
		$cleanedPassword = $this->valid_donnees($data['password']);
		$password = password_hash($cleanedPassword, PASSWORD_DEFAULT);

		// Sécurisation de la requête
		if (!empty($password)
		&& strlen($cleanedPassword) <= 50
		&& !empty($email)
		&& preg_match("#^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$#", $email)) {

			// Requête de modification de la table users en bdd
			$sql = "UPDATE users SET user_password = :password WHERE user_email = :email";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->bindParam(':email', $email, PDO::PARAM_STR);

			// Si la requête a fonctionné et modifié au moins 1 row, return TRUE
			if ($query->execute() && $query->rowCount() > 0) {
				return TRUE;
			}
		}
	}
}