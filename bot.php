<?php
/* Includes */
require "predis/autoload.php";
include 'methods.php';
$config = include 'config.php';

/* Configuraciones */
$bot = new api;
$redis = new Predis\Client();
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
if (!$updates) { return; };
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

foreach ($config["plugins"] as $plugin) {
    $actual_plugin = include_once "plugins/".$plugin;
    $actioned = false;
    if (isset($actual_plugin["pre_process"])) {
        call_user_func($actual_plugin["pre_process"], $msg);
    };
    if (isset($actual_plugin["exe"])) {
        foreach ($actual_plugin["patterns"] as $pattern) {
            preg_match($pattern, $msg["text"], $matches, PREG_OFFSET_CAPTURE);
            if ($matches) {
                call_user_func($actual_plugin["exe"], $msg, $matches);
                $actioned = true;
                break;
            };
        };
    };
    if ($actioned) { break; };
};

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
