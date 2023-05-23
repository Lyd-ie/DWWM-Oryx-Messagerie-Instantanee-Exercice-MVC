<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Messagerie</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/style.css">
</head>

<body>
<header>
	<!-- Bouton de déconnection -->
	<form method="post" action="../../">
		<button type="submit" name="logout" class="btn btn-info">LOGOUT</button>
	</form>
	<!-- Liens des chatrooms et recherche -->
    <ul>
        <li><a href="/online_formapro/messagerie/chatmvc/chat/chatIndex/1">Bienvenue</a></li>
        <li><a href="/online_formapro/messagerie/chatmvc/chat/chatIndex/2">Veille technologique</a></li>
        <li><a href="/online_formapro/messagerie/chatmvc/chat/chatIndex/3">Divers</a></li>
        <li><a href="/online_formapro/messagerie/chatmvc/chat/chatIndex/4">Room 1</a></li>
        <li><a href="/online_formapro/messagerie/chatmvc/chat/chatIndex/5">Room 2</a></li>
        <li><a href="/online_formapro/messagerie/chatmvc/chat/search">Rechercher</a></li>
    </ul>
</header>

<h1>Vous discutez dans la room " <?php echo $currentRoom; ?> "</h1>

	<!-- CHATBOX -->
	<div class="chat-wrapper">
		<div id="message-box">
			<!-- S'il y a des messages enregistrés dans la chatroom sélectionnée -->
			<?php if (!empty($result)) {
				for ($i = 0; $i < count($result); $i++) {
					$user = $result[$i]->user_name;
					$message = $result[$i]->msg_text;
					$date = $result[$i]->msg_date;
					$color = $result[$i]->msg_color;
					
					// Les 10 derniers messages sont affichés (ordre chronologique) 
					echo '<div><span class="user_name" style="color:'.$color.'">'.$user.', '.$date.'</span> : <span class="user_message">'.$message.'</span></div>';
				}
			} ?>
		</div>
		<div class="user-panel">
			<!-- Si un utilisateur est enregistré dans $_SESSION -->
			<?php if (!empty($_SESSION['user_id'])) {
				// L'input "name" est alors désactivé pour afficher son pseudo par défaut
				echo '<input type="text" name="name" id="name" placeholder="'. $_SESSION['user_name'] . '" value="' . $_SESSION['user_name'] .'" disabled>';

			} else {
				// Sinon l'input "name" est laissé enabled et l'utilisateur peut noter le pseudo de son choix
				echo '<input type="text" name="name" id="name" placeholder="Your Name" maxlength="15" pattern="^[A-Za-zÀ-ÿ0-9 -]+$">';
			} ?>

			<input type="text" name="message" id="message" placeholder="Type your message here..." maxlength="100" pattern="^[A-Za-zÀ-ÿ0-9 '.!?-]+$">
			<button id="send-message">Send</button>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../../js/main.js"></script>
</body>
</html>