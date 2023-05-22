<?php
$colors = array('#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00');
$color_pick = array_rand($colors);

?>

<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Messagerie</title>
	<link rel="stylesheet" href="../../css/style.css">
		
	</style>
</head>

<body>
<header>
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

	<div class="chat-wrapper">
		<div id="message-box">
		 
			<?php if (!empty($result)) {
				for ($i = 0; $i < count($result); $i++) {
					$user = $result[$i]->user_name;
					$message = $result[$i]->msg_text;
					$date = $result[$i]->msg_date;
					$color = $result[$i]->msg_color;

					echo '<div><span class="user_name" style="color:'.$color.'">'.$user.', '.$date.'</span> : <span class="user_message">'.$message.'</span></div>';
				}
			 }
			//   else {
			// 	echo "";
			// }
			 ?>

		</div>
		<div class="user-panel">
			<?php if (!empty($_SESSION['user_id'])) {
				echo '<input type="text" name="name" id="name" placeholder="'. $_SESSION['user_name'] . '" value="' . $_SESSION['user_name'] .'" disabled>';
			} else {
				echo '<input type="text" name="name" id="name" placeholder="Your Name" maxlength="15">';
			}	 ?>
			<input type="text" name="message" id="message" placeholder="Type your message here..." maxlength="100">
			<button id="send-message">Send</button>
		</div>
	</div>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../chatmvc/js/main.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../../js/main.js"></script>
</body>
</html>