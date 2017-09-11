<?php
$exe = function($msg, $matches) {
    global $bot;
    $bot->sendReply($msg, "¡Hola ".$msg["from"]["first_name"]."! Reenviame un mensaje para obtener el id del usuario, o canal, o envíame un mensaje para saber tu id.");
};

return array(
    "exe" => $exe,
    "patterns" => array(
        "/\/start/"
    )
)
?>
