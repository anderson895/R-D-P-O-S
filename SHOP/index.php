<?php 
// Define routes
$routes = [
    'login' => 'login',
    'logout' => 'logout',
    'register' => 'register',
    'home' => 'home',
    'about' => 'about',
    'contact' => 'contact',
    'post_login' => 'post_login'
];

// Get the requested URI
$requestUri = trim($_SERVER['REQUEST_URI'], '/');
$parsedUrl = parse_url($requestUri, PHP_URL_PATH);
$pathSegments = explode('/', trim($parsedUrl, '/'));
$requestUri = end($pathSegments);

// echo''. $requestUri .'';
// Remove query string from the URI
if ($pos = strpos($requestUri, '?')) {
    $requestUri = substr($requestUri, 0, $pos);
}

// Check if the route exists
if (array_key_exists($requestUri, $routes)) {
    $controller = $routes[$requestUri];
} else {
    $controller = '404';
}

// Include the corresponding controller
switch ($controller) {
    case 'login':
        include ('login.php');
        break;
    case 'logout':
        include ('server/logout.php');
        break;
    case 'register':
        include ('register.php');
        break;
    case 'post_login':
        include ('server/post_login.php');
        break;
    case 'home':
        include 'home.php';
        break;
    case 'about':
        include 'about.php';
        break;
    case 'contact':
        include 'contact.php';
        break;
    default:
        include '404.php';
        break;
}

?>