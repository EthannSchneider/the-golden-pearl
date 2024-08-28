<?php
require 'vendor/autoload.php';

session_start();

$route = $_SERVER['REQUEST_URI'] ?? '/';
$route = explode('?', $route)[0];

if (str_starts_with($route, '/api')) {
    require 'router.php';
} else {
    frontend_redirect($route);
}

function frontend_redirect($route) {
    if (!str_contains($route, '.')) {
        include 'views/index.html';
    } else {
        if (file_exists('views' . $route)) {
            change_content_type($route);
            echo file_get_contents("views/$route"); 
        } else {
            $_SERVER['REQUEST_URI'] = '/notfound';
            include 'views/index.html';
            header('HTTP/1.0 404 Not Found');
        }
    }
}

function change_content_type($route) {
    $ext = explode('.', $route);
    if (count($ext) === 1) {
        return;
    }
    switch ($ext[count($ext) - 1]) {
        case 'css':
            header('Content-Type: text/css');
            break;
        case 'js':
            header('Content-Type: text/javascript');
            break;
        case 'png':
            header('Content-Type: image/png');
            break;
        case 'jpg':
            header('Content-Type: image/jpg');
            break;
        case 'jpeg':
            header('Content-Type: image/jpeg');
            break;
        case 'gif':
            header('Content-Type: image/gif');
            break;
        case 'svg':
            header('Content-Type: image/svg+xml');
            break;
        case 'ico':
            header('Content-Type: image/x-icon');
            break;
        case 'json':
            header('Content-Type: application/json');
            break;
        case 'xml':
            header('Content-Type: application/xml');
            break;
        case 'pdf':
            header('Content-Type: application/pdf');
            break;
        case 'zip':
            header('Content-Type: application/zip');
            break;
        case 'mp3':
            header('Content-Type: audio/mpeg');
            break;
        case 'mp4':
            header('Content-Type: video/mp4');
            break;
        case 'webm':
            header('Content-Type: video/webm');
            break;
        case 'ogg':
            header('Content-Type: video/ogg');
            break;
        case 'flac':
            header('Content-Type: audio/flac');
            break;
        case 'wav':
            header('Content-Type: audio/wav');
            break;
        case 'avi':
            header('Content-Type: video/x-msvideo');
            break;
        case 'wmv':
            header('Content-Type: video/x-ms-wmv');
            break;
        case 'flv':
            header('Content-Type: video/x-flv');
            break;
        case 'mov':
            header('Content-Type: video/quicktime');
            break;
        case 'html':
            header('Content-Type: text/html');
            break;
        case 'txt':
            header('Content-Type: text/plain');
            break;
        case 'csv':
            header('Content-Type: text/csv');
            break;
    }
}