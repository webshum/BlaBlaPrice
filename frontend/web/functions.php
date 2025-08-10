<?php 

ini_set('error_log', '/home/firko198/blablaprice.com/frontend/web/error.log');

function get_token($code, $user) {
    $ku = curl_init();

    $query = "";
    print_r($user);
}

function active($string) {
    if (preg_match("~$string~", $_SERVER['REQUEST_URI'])) {
        return 'active';
    }

    return '';
}

function dd($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die;
}

function dump($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

?>