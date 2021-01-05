<?php

    session_start();
    require_once(__DIR__ . "/../assets/inc/userList.inc.php");
    require_once(__DIR__ . "/../assets/inc/checkLogin.inc.php");

    if (!checkLogin()) {
        header('WWW-Authenticate: OAuth realm="Access to fileExplorer"', true, 401);
        header("Content-Type: text/plain", true);
        die("invalid login");
    }

    if (isset($_GET["path"])){
        $path = $_GET["path"];
    }else{
        header("Content-Type: text/plain", true, 400);
        die("Missing Path");
    }

    if (is_dir($path)) {
        header("Content-Type: text/plain", true, 418);
        die("This is a directory");
    }

    $mime = mime_content_type($path);
    header("Content-Type: " . $mime);
    echo file_get_contents($path);

?>
