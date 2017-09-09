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

function get_vardump($var) {
    ob_start();
    var_dump($var);
    return ob_get_clean();
};

$updates = file_get_contents("php://input");
$updates = json_decode($updates, TRUE);

$msg = $updates["message"];
$msg["cb"] = $updates["callback_query"];

if ($config["var_dump"]) {
    $result = get_vardump($msg);
    if ($result) {
        $bot->sendMessage($config["owners"][0], $result);
        return;
    }
};

for ($i=0; $i<sizeof($config["plugins"]); $i++) {
    $actual_plugin = include "plugins/".$config["plugins"][$i];
    if (isset($actual_plugin["pre_process"])) {
        call_user_func($actual_plugin["pre_process"], $bot, $msg, $matches);
    };
    if (isset($actual_plugin["exe"])) {
        for ($m=0; $m<sizeof($actual_plugin["patterns"]); $m++) {
            preg_match($actual_plugin["patterns"][$m], $msg["text"], $matches, PREG_OFFSET_CAPTURE);
            if ($matches) {
                call_user_func($actual_plugin["exe"], $bot, $msg, $matches);
                break;
            }
        }
    };
};

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
