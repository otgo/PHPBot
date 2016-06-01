<?php

$botToken = "189074074:AAH2PmSI_TOfmfFzWa7uzkUlcc0QU5W5X84";
$website = "https://api.telegram.org/bot".$botToken;

?>

<form action="<?php echo $website.'/sendPhoto' ?>" methos="post" enctype"multipart/form-data">

	<input type="text" name="chat_id" value="189041244" />
	<input type="file" name="photo" />
	<input type="submit" value="Enviar" />

</form>
