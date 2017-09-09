<?php
/* Includes */
include 'methods.php';
$config = include 'config.php';

/* Configuraciones */
$bot = new api;
$GLOBALS['website'] = "https://api.telegram.org/bot".$config["token"];
/*---------------------------*/

function mdEscape($text) {
    $rep = array('*' => '\\*', '_' => '\\_', '[' => '\\[', '`' => '\\`');
    return str_replace(array_keys($rep), array_values($rep), $text);
};

$updates = file_get_contents("php://input");
$updates = json_decode($updates, TRUE);

$msg = $updates["message"];

$teclado = array(
    "inline_keyboard" => array(
        array(
            array(
                "text" => "Canal moderatorz",
                "url" => "https://telegram.me/Moderatorz"
            ),
            array(
                "text" => "Trucos Telegram",
                "url" => "https://telegram.me/trucostelegram"
            )
        ),
        array(
            array(
                "text" => "Google",
                "url" => "https://google.com"
            )
        )
    )
);

if ($config["var_dump"]) {
    ob_start();
    var_dump($msg);
    $result = ob_get_clean();
    if ($result) {
        $bot->sendMessage($config["owners"][0], $result, false, false, false);
        return;
    }
};

if (isset($msg["forward_from_chat"])) {
    $username = $msg["forward_from_chat"]["username"]?"@".mdEscape($msg["forward_from_chat"]["username"]):"";
    $type = $msg["forward_from_chat"]["type"]?"\n*Type*: ".$msg["forward_from_chat"]["type"]:"";
    $bot->sendReply($msg, $username."\n*Id*: ".$msg["forward_from_chat"]["id"]."\n*Title*: ".mdEscape($msg["forward_from_chat"]["title"]).$type, "markdown", false);
    return;
};

if (isset($msg["forward_from"])) {
    $msg["from"] = $msg["forward_from"];
};

if (isset($msg["text"]) && isset($msg["from"])) {
    $last_name = $msg["from"]["last_name"]?"\n*Last*: ".$msg["from"]["last_name"]:"";
    $username = $msg["from"]["username"]?"@".mdEscape($msg["from"]["username"]):"";
    $language_code = $msg["from"]["language_code"]?"\n*Lang*: ".$msg["from"]["language_code"]:"";
    $bot->sendReply($msg, $username."\n*Id*: ".$msg["from"]["id"]."\n*First*: ".mdEscape($msg["from"]["first_name"]).$last_name.$language_code, "markdown", false);
};

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
