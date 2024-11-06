<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function add($route, $params = [])
    {
        // Converter parâmetros para expressões regulares
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_-]+)', $route);
        $route = '/^' . $route . '$/';

        $this->routes[$route] = $params;
    }

    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Extrair parâmetros nomeados
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                return $params;
            }
        }
        return false;
    }

    public function dispatch($url)
    {
        $url = $this->removeQueryString($url);

        $params = $this->match($url);
        if ($params) {
            if (isset($params['middleware']) && !$this->runMiddleware($params['middleware'])) {
                header('Location: /login');
                exit;
            }

            $controller = $params['controller'];
            $controller = "App\\Controllers\\$controller";
            if (class_exists($controller)) {
                $controller_object = new $controller();

                $action = $params['action'] ?? 'index';
                if (method_exists($controller_object, $action)) {
                    // Passar os parâmetros dinâmicos para o método do controlador
                    call_user_func_array([$controller_object, $action], array_slice($params, 2));
                } else {
                    echo "Método $action não encontrado no controlador $controller";
                }
            } else {
                echo "Controlador $controller não encontrado";
            }
        } else {
            echo "Nenhuma rota encontrada para a URL: " . htmlspecialchars($url);
        }
    }

    protected function runMiddleware($middleware)
    {
        if ($middleware === 'auth') {
            return isset($_SESSION['user_id']);
        }

        return true;
    }

    protected function removeQueryString($url)
    {
        if ($url != '') {
            $parts = explode('?', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }
}
