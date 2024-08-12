<?php 
// Define routes
$routes = [
    'login' => 'login',
    'home' => 'home',
    'about' => 'about',
    'contact' => 'contact'
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
        include ('controllers/login.php');
        break;
    case 'home':
        include 'controllers/home.php';
        break;
    case 'about':
        include 'controllers/about.php';
        break;
    case 'contact':
        include 'controllers/contact.php';
        break;
    default:
        include 'controllers/404.php';
        break;
}

?>