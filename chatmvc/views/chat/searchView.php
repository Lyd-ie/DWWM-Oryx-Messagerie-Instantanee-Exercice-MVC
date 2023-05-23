<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Messagerie</title>
	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <a href="/online_formapro/messagerie/chatmvc/chat/chatIndex/1">Retour</a>
    <h1>RECHERCHE DANS LE CHAT</h1>
    <h2>Vous êtes connecté en tant que <?php echo $_SESSION['user_name'] ?> </h2>
    <form role="form" method="post" action="search">
        <input type="search" name="input" placeholder="Saisir un mot clé" maxlength="50" pattern="^[A-Za-zÀ-ÿ0-9 '.!?-]+$">
        <button type="submit" name="search" class="btn btn-info">Envoyer</button>
    </form>

    <div>
            
        <?php if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $user = $result[$i]->user_name;
                $message = $result[$i]->msg_text;
                $date = $result[$i]->msg_date;
                $room = $result[$i]->room_name;

                echo '<div>'.$user.' @ '.$room.' le ' .$date.' a écrit :<br>'.$message.'</div>';
            }
        } ?>

    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../../js/main.js"></script>
</body>
</html>