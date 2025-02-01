<?php

// Définition du répertoire racine
$root = __DIR__ . '/../src/php/';

// Récupération de l'URL demandée
$request = trim($_SERVER['REQUEST_URI'], '/');
$request = str_replace('app-sport/', '', $request);
$request = explode('?', $request, 2)[0];

switch ($request) {
    case '':
    case 'home':
        require $root . 'pages/home.php';
        break;
    case 'admin/login':
        require $root . 'admin/login.php';
        break;
    case 'products':
        require $root . 'pages/product.php';
        break;
    case 'admin/dashboard':
        require $root . 'admin/dashboard.php';
        break;
    case 'admin/register':
        require $root . 'admin/register.php';
        break;
    case 'admin/logout':
        require $root . 'admin/logout.php';
        break;
    default:
        http_response_code(404);
        require $root . 'pages/error404.php';
        break;
}
?>
