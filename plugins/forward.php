<?php
$pre_process = function ($msg) {
    global $bot;
    if (isset($msg["forward_from_chat"])) {
        $username = $msg["forward_from_chat"]["username"]?"@".mdEscape($msg["forward_from_chat"]["username"]):"";
        $type = $msg["forward_from_chat"]["type"]?"\n*Type*: ".$msg["forward_from_chat"]["type"]:"";
        $bot->sendReply($msg, $username."\n*Id*: ".$msg["forward_from_chat"]["id"]."\n*Title*: ".mdEscape($msg["forward_from_chat"]["title"]).$type, "markdown");
        return;
    };

    if (isset($msg["forward_from"])) {
        $msg["from"] = $msg["forward_from"];
    };

    if (isset($msg["text"]) && isset($msg["from"])) {
        $last_name = $msg["from"]["last_name"]?"\n*Last*: ".$msg["from"]["last_name"]:"";
        $username = $msg["from"]["username"]?"@".mdEscape($msg["from"]["username"]):"";
        $language_code = $msg["from"]["language_code"]?"\n*Lang*: ".$msg["from"]["language_code"]:"";
        $bot->sendReply($msg, $username."\n*Id*: ".$msg["from"]["id"]."\n*First*: ".mdEscape($msg["from"]["first_name"]).$last_name.$language_code, "markdown");
    };
};

return array(
    "pre_process" => $pre_process
)

?>
