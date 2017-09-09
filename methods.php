<?php

function APIRequest($method) {
    $url = $GLOBALS['website']."/".$method;
    return json_decode(file_get_contents($url));
};

class api {
    function sendMessage($chat_id, $message, $parse_mode, $reply_markup, $reply_to_message_id) {
        $url = "sendMessage?chat_id=".$chat_id."&text=".urlencode($message);
        if ($parse_mode) {
            $url .= "&parse_mode=".$parse_mode;
        }
        if ($reply_markup) {
            $url .= "&reply_markup=".json_encode($reply_markup);
        }
        if ($reply_to_message_id) {
            $url .= "&reply_to_message_id=".$reply_to_message_id;
        }
        return APIRequest($url);
    }

    function sendReply($msg, $message, $parse_mode, $reply_markup) {
        return $this->sendMessage($msg["chat"]["id"], $message, $parse_mode, $reply_markup, $msg["message_id"]);
    }
};

?>
