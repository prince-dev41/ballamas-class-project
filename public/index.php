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
        require $root . 'pages/products.php';
        break;
    case 'product-detail':
        require $root . 'pages/product-detail.php';
        break;
    case 'admin/dashboard':
        require $root . 'admin/dashboard.php';
        break;
    case 'admin/categories':
        require $root . 'admin/categories.php';
        break;
    case 'admin/customers':
        require $root  . 'admin/customers.php';
        break;
    case 'admin/setting':
        require $root . 'admin/setting.php';
        break;
    case 'admin/products':
        require $root . 'admin/products.php';
        break;
    case 'admin/order':
        require $root . 'admin/order.php';
        break;
    case 'cart' :
        require $root . 'pages/cart.php';
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
