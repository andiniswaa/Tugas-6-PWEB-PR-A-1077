<?php
function view($page, $data=[]) {
    extract($data);
    include 'view/'.$page.'.php';
}

class Router { 
    public static $urls = [];

    function __construct() {
        $url = implode("/", 
            array_filter(
                explode("/", 
                    str_replace($_ENV['BASEDIR'], "", 
                        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
                    )
                ), 'strlen'
            )
        );

        if (!in_array($url, self::$urls['routes'])) {
            header('Location: '.BASEURL);
        }

        $call = self::$urls[$_SERVER['REQUEST_METHOD']][$url];
        $call();
    }
    public static function url($url, $method, $callback) {
        if ($url == '/') { $url = ''; }
        self::$urls[strtoupper($method)][$url] = $callback;
        self::$urls['routes'][] = $url;
        self::$urls['routes'] = array_unique(self::$urls['routes']);
    }
}

function urlpath($path) {
    require_once 'config/static.php';
    return BASEURL.$path;
}

function freshdb() {
    require_once 'model/user_model.php';
    require_once 'model/contact_model.php';
    global $conn;
    $conn->query('DELETE FROM users');
    $conn->query('ALTER TABLE users AUTO_INCREMENT = 1');
    $conn->query('DELETE FROM contacts');
    $conn->query('ALTER TABLE contacts AUTO_INCREMENT = 1');

    User::daftar([
        'nama' => $_ENV['NAMA'],
        'warna' => $_ENV['WARNA'],
        'ras' => $_ENV['RAS']
    ]);

    $contacts = array(
        ['leon gapura', 'ginger', 'anggora', 1],
        ['rifi', 'black', 'BSH', 2],
        ['dena', 'white', 'BSH', 3]
    );

    foreach ($contacts as $c) {
        Contact::insert([
                'phone_number' => $c[0],
                'owner' => $c[1],
                'inserted_at'=> $c[2],
                'user_fk' => 1,
                'city_fk' => $c[3]
                ]);
    }
    view('freshdb');
    session_destroy();
}