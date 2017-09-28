<?php
$exe = function($msg, $matches) {
    global $bot; global $utils;
    $val = $utils->is_bot_creator($msg["from"]["id"]);
    if ($val) {
        $bot->sendDocument($msg["chat"]["id"], $matches[1][0]);
    } else {
        $bot->sendMessage($msg["chat"]["id"], "You are not creator. (".$val.")");
    }
};

return array(
    "exe" => $exe,
    "patterns" => array(
        "/\/sendfile (.+)/"
    )
)
?>
