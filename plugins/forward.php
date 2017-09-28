<?php
$pre_process = function ($msg) {
    global $bot; global $utils;
    if ($msg["chat"]["type"] != "private") { return; };
    if (isset($msg["forward_from_chat"])) {
        $username = $msg["forward_from_chat"]["username"]?"@".$utils->nm($msg["forward_from_chat"]["username"]):"";
        $type = $msg["forward_from_chat"]["type"]?"\n*Type*: ".$msg["forward_from_chat"]["type"]:"";
        $bot->sendReply($msg, $username."\n*Id*: ".$msg["forward_from_chat"]["id"]."\n*Title*: ".$utils->nm($msg["forward_from_chat"]["title"]).$type, "markdown");
        return;
    };

    if (isset($msg["forward_from"])) {
        $msg["from"] = $msg["forward_from"];
    };

    if (isset($msg["from"])) {
        $last_name = $msg["from"]["last_name"]?"\n*Last*: ".$msg["from"]["last_name"]:"";
        $username = $msg["from"]["username"]?"@".$utils->nm($msg["from"]["username"]):"";
        $language_code = $msg["from"]["language_code"]?"\n*Lang*: ".$msg["from"]["language_code"]:"";
        $is_bot = $msg["from"]["is_bot"]?"true":"false";
        $bot->sendReply($msg, $username."\n*Id*: ".$msg["from"]["id"]."\n*First*: ".$utils->nm($msg["from"]["first_name"]).$last_name.$language_code."\n*Is_bot*: ".$is_bot, "markdown");
    };
    return;
};

return array(
    "pre_process" => $pre_process
)

?>
