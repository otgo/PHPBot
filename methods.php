<?php

function request($method) {
    $url = $GLOBALS['website']."/".$method;
    $content = file_get_contents($url);
    return $content;
}

function curl_upload($url, $post) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $result=curl_exec ($ch);
    curl_close ($ch);
    return $result;
}

class api {
    function sendMessage($chat_id, $message, $parse_mode=NULL, $reply_markup=NULL, $reply_to_message_id=NULL) {
        $method = "sendMessage?chat_id=".$chat_id."&text=".urlencode($message);
        if ($parse_mode) {
            $method .= "&parse_mode=".$parse_mode;
        }
        if ($reply_markup) {
            $method .= "&reply_markup=".json_encode($reply_markup);
        }
        if ($reply_to_message_id) {
            $method .= "&reply_to_message_id=".$reply_to_message_id;
        }
        return array($method, request($method));
    }

    function sendReply($msg, $message, $parse_mode=NULL, $reply_markup=NULL) {
        return $this->sendMessage($msg["chat"]["id"], $message, $parse_mode, $reply_markup, $msg["message_id"]);
    }

    function deleteMessage($chat_id, $message_id) {
        $method = "deleteMessage?chat_id=".$chat_id."&message_id=".$message_id;
        return request($method);
    }

    function sendDocument($chat_id, $document) {
        $url = $GLOBALS['website']."/sendDocument";
        $document = realpath($document);
        $document = new CURLFile($document);
        $post = array("chat_id" => $chat_id, "document" => $document);
        return curl_upload($url, $post);
    }

    function setWebhook($token, $url) {
        $req = "https://api.telegram.org/bot".$token."/setWebhook?url=".$url;
        return file_get_contents($req);
    }

    function deleteWebhook($token) {
        $req = "https://api.telegram.org/bot".$token."/deleteWebhook";
        return file_get_contents($req);
    }
};

?>
