<?php

class utils {
    function nm($text) {
        $rep = array('*' => '\\*', '_' => '\\_', '[' => '\\[', '`' => '\\`');
        return str_replace(array_keys($rep), array_values($rep), $text);
    }

    function get_vardump($var) {
        ob_start();
        var_dump($var);
        return ob_get_clean();
    }

    function is_bot_creator($user_id) {
        global $config;
        for ($i=0; $i<sizeof($config["owners"]); $i++) {
            if ($config["owners"][$i] == $user_id) {
                return true;
            }
        }
        return false;
    }
}
?>
