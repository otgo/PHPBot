<?php
$exe = function($msg, $matches) {
    global $bot; global $utils;
    if ($matches[1][0] == "isend") {
        $arr = json_decode($matches[4][0]);
        $arr_cpy = array("inline_keyboard" => $arr);
        $dat = $bot->sendMessage($matches[2][0], $matches[3][0], "markdown", $arr_cpy);
        //$bot->sendMessage($msg["chat"]["id"], $dat[0]."\n".$matches[3][0]." TYPE: ".$arr);
    } elseif ($matches[1][0] == "ksend") {
        $arr = json_decode($matches[4][0]);
        $arr_cpy = array("keyboard" => $arr);
        $dat = $bot->sendMessage($matches[2][0], $matches[3][0], "markdown", $arr_cpy);
    }
};

return array(
    "exe" => $exe,
    "patterns" => array(
        "/^\/(isend) (\S+) (.+)\n\n(.+)$/s",
        "/^\/(ksend) (\S+) (.+)\n\n(.+)$/s"
    )
)


/* Ejemplo de comando inline:

/isend 189041244 👨‍💻 Canales de interés 💻

[
  [
    {"text":"🔍 Google","url":"t.me/google"}
  ],
  [
    {"text":"🍉 TeamFruit","url":"t.me/teamfruit"},
    {"text":"📱 Trucos Telegram","url":"t.me/TrucosTelegram"}
  ]
]

*/

?>
