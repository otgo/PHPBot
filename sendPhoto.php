<?php

$botToken = "APIKEY";
$website = "https://api.telegram.org/bot".$botToken;

?>

<form action="<?php echo $website.'/sendPhoto' ?>" methos="post" enctype"multipart/form-data">

	<input type="text" name="chat_id" value="" />
	<input type="file" name="photo" />
	<input type="submit" value="Enviar" />

</form>
