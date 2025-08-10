<?php 

function active($string) {
    if (preg_match("~$string~", $_SERVER['REQUEST_URI'])) {
        return 'active';
    }

    return '';
}

function dd($data) {
    echo '<style>
        .dump-wrapper {
            background: #f8f9fa;
            color: #212529;
            font-family: monospace;
            padding: 1em;
            margin: 1em 0;
            border-left: 5px solid #b72e2e;
            overflow: auto;
            white-space: pre-wrap;
        }
    </style>';
    echo '<div class="dump-wrapper">';
    print_r($data);
    echo '</div>';
    die;
}

function dump($data) {
    echo '<style>
        .dump-wrapper {
            background: #f8f9fa;
            color: #212529;
            font-family: monospace;
            padding: 1em;
            margin: 1em 0;
            border-left: 5px solid #3490dc;
            overflow: auto;
            white-space: pre-wrap;
        }
    </style>';
    echo '<div class="dump-wrapper">';
    print_r($data);
    echo '</div>';
}

function detectLanguage(array $availableLanguages, string $defaultLang = 'ua'): string
{
    session_start();

    if (isset($_GET['lang']) && in_array($_GET['lang'], $availableLanguages, true)) {
        $_SESSION['language'] = $_GET['lang'];
    }

    $lang = $_SESSION['language']
        ?? ($_COOKIE['language'] ?? $defaultLang);

    $_ENV['APP_CURRENT_LANG'] = $lang;
    putenv("APP_CURRENT_LANG=$lang");

    setcookie('language', $lang, time() + 86400 * 30, '/');

    return $lang;
}

?>