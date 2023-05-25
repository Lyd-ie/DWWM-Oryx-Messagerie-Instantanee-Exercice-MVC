<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Messagerie</title>
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="icon" type="image/x-icon" href="../../css/logo">
</head>

<body>
	<header>
		<!-- Bouton de déconnection -->
		<form method="post" action="../../">
			<button type="submit" name="logout">Déconnection</button>
		</form>
	</header>

	<div class="align">
		<!-- CHATBOX -->
		<div class="chat-wrapper">
			<div class="chatroom">
				<!-- Logo et titre -->
				<img src="../../css/logonb.png" alt="logo">
				<span class="title">Vous discutez dans la room...</span>
				<!-- Sélecteur de chatrooms -->
				<select name="room" id="rooms" onchange="window.open(this.value, '_self')">
					<option value="<?php echo $roomId; ?>" selected hidden><?php echo $currentRoom; ?></option>
					<option value="1">Bienvenue</option>
					<option value="2">Veille technologique</option>
					<option value="3">Divers</option>
					<option value="4">Room 1</option>
					<option value="5">Room 2</option>
				</select>
			</div>

			<!-- Affichage des messages -->
			<div id="message-box">
				<!-- S'il y a des messages enregistrés dans la chatroom sélectionnée -->
				<?php if (!empty($result)) {
					for ($i = 0; $i < count($result); $i++) {
						$user = $result[$i]->user_name;
						$message = $result[$i]->msg_text;
						$date = $result[$i]->msg_date;
						$color = $result[$i]->msg_color;
						
						// Les 10 derniers messages sont affichés (ordre chronologique) 
						echo '<div class="message"><p class="user_name" style="border-left: 2px solid'.$color.'">'.$user.'<span class="italic">'.$date. ': </span></p>
						<p class="user_message">'.$message.'</p></div>';
					}
				} else {
					echo '<div><span class="user_message italic">Commencez une discussion !</span></div>';
				} ?>
			</div>
			<!-- Zone de saisie de messages -->
			<div class="user-panel">
				<!-- Si un utilisateur est enregistré dans $_SESSION -->
				<?php if (!empty($_SESSION['user_id'])) {
					// L'input "name" est alors désactivé pour afficher son pseudo par défaut
					echo '<input name="name" class="name" id="name" value="' . $_SESSION['user_name'] .'" disabled>';
				} else {
					// Sinon l'input "name" est laissé enabled et l'utilisateur peut noter le pseudo de son choix
					echo '<input name="name" id="name" placeholder="Your Name" maxlength="15" pattern="^[A-Za-zÀ-ÿ0-9 -]+$">';
				} ?>
				<input name="message" id="message" placeholder="Ecrivez un message" maxlength="500" pattern="^[A-Za-zÀ-ÿ0-9 ',.:^!?-]+$">
				<button class="chatButton" id="send-message">Envoyer</button>
			</div>
		</div>
		<!-- Zone de recherche -->
		<div class="recherche">
			<form method="post">
				<span>Rechercher <br>dans le chat :</span>
				<input type="search" name="input" placeholder="Saisir un mot clé" >
				<button type="submit" name="search">Rechercher</button>
			</form>
		</div>
	</div>

	<!-- Popup des résultats de recherche -->
	<div class="overlay">
		<div class="popup searchResults">
			<a class="close" href="">&times;</a>
			<h1>Résultats de la recherche</h1>
			<p style="text-align:center;margin:-1% auto 3%">Cliquez sur un résultat pour accéder à la room correspondante</p>
			<div class="results">
				<!-- Si la recherche par mot clé retourne un résultat -->
				<?php if (!empty($research)) {
					// Affiche la popup contenant les résultats
					echo '<script>
						const overlay = document.querySelector(".overlay");
						overlay.style.visibility = "visible";
						overlay.style.opacity = "1";
						</script>';
					
					// Récupère l'ensemble des résultats du tableau $research
					for ($i = 0; $i < count($research); $i++) {
						$User = $research[$i]->user_name;
						$Message = $research[$i]->msg_text;
						$Color = $research[$i]->msg_color;
						$Date = $research[$i]->msg_date;
						$Room = $research[$i]->room_name;
						$RoomID = $research[$i]->room_id;
		
						// Affiche les résultats mis en forme
						echo '<a href="'.$RoomID.'">
							<div class="result">
							<p class="user_name" style="border-left: 2px solid'.$Color.'">'.$User.'
							<span class="normal">le</span>
							<span class="italic">'.$Date. '</span>
							<span class="normal">dans la room</span>
							<span class="bold">"'.$Room.'"</span></p>
							<p class="user_message">'.$Message.'</p></div></a>';
					}
				} ?>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../../js/main.js"></script>

</body>
</html>