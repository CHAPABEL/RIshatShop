<?php
class Router {
    protected $routes = [
        '/' => ['HomeController', 'index'],
        '/catalog' => ['CatalogController', 'index'],
        '/product' => ['ProductController', 'view'],
        '/cart' => ['CartController', 'index'],
        '/checkout' => ['CheckoutController', 'index'],
        '/login' => ['AuthController', 'login'],
        '/register' => ['AuthController', 'register'],
        '/logout' => ['AuthController', 'logout'],
        '/profile' => ['UserController', 'profile'],
        '/admin' => ['AdminController', 'index'],
        '/admin/products' => ['AdminController', 'products'],
        '/admin/products/add' => ['AdminController', 'addProduct'],
        '/admin/products/edit' => ['AdminController', 'editProduct'],
        '/admin/products/delete' => ['AdminController', 'deleteProduct'],
        '/admin/users' => ['AdminController', 'users'],
        '/admin/orders' => ['AdminController', 'orders'],
    ];

    public function dispatch($uri) {
        $path = parse_url($uri, PHP_URL_PATH);
        // Поддержка экшенов для корзины
        if ($path === '/cart' && isset($_GET['action'])) {
            $action = $_GET['action'];
            $controllerFile = __DIR__ . '/../Controllers/CartController.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $ctrl = new CartController();
                if (method_exists($ctrl, $action)) {
                    $ctrl->$action();
                    return;
                }
            }
        }
        if (isset($this->routes[$path])) {
            [$controller, $action] = $this->routes[$path];
            $controllerFile = __DIR__ . '/../Controllers/' . $controller . '.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $ctrl = new $controller();
                call_user_func([$ctrl, $action]);
                return;
            }
        }
        http_response_code(404);
        echo 'Страница не найдена';
    }
}
