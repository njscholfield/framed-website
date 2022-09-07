<?php 
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
        require 'index.php';
        break;
    case '/about/':
        require 'about/index.php';
        break;
    case '/admin/':
        require 'admin/index.php';
        break;
    case '/admin/items/':
        require 'admin/items/index.php';
        break;
    case '/admin/items/update.php':
        require 'admin/items/update.php';
        break;
    case '/admin/items/':
        require 'admin/items/index.php';
        break;
    case '/admin/orders/':
        require 'admin/orders/index.php';
        break;
    case '/admin/orders/info.php':
        require 'admin/orders/info.php';
        break;
    case '/cart/':
        require 'cart/index.php';
        break;
    case '/checkout/':
        require 'checkout/index.php';
        break;
    case '/favorites/':
        require 'favorites/index.php';
        break;
    case '/favorites/modify.php':
        require 'favorites/modify.php';
        break;
    case '/item/':
        require 'item/index.php';
        break;
    case '/item/info.php':
        require 'item/info.php';
        break;
    case '/login/':
        require 'login/index.php';
        break;
    case '/logout/':
        require 'logout/index.php';
        break;
    case '/item/':
        require 'item/index.php';
        break;
    case '/profile/':
        require 'profile/index.php';
        break;
    case '/profile/orders/':
        require 'profile/orders/index.php';
        break;
    case '/register/':
        require 'register/index.php';
        break;
    case '/store/':
        require 'store/index.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
}
?>