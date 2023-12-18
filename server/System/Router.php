<?php

namespace System;

use Closure;
use Exception;
use System\Authenticate;

class Router
{
    protected $routes = []; // stores routes
    protected $auth;
    protected $proteger = null;

    public function addRoute(
        string $method,
        string $url,
        Closure $target,
        $protect = EnumProtect::Public
    ) {

        // if ($protect == EnumProtect::Private)
        // {           
        //     $this->auth->Proteger();
        // }

        $this->routes[$method][$url] = $target;
        $this->routes[$method]["proteger"] = $protect;
    }

    public function Authenticate($TipoAuth)
    {
        $this->auth = new Authenticate($TipoAuth);
    }

    public function Proteger($TipoAuth)
    {
        $this->proteger = $TipoAuth;
    }

    public function matchRoute($dir = "server")
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = str_replace($dir . "/", "", $_SERVER['REQUEST_URI']);

 
        if (isset($this->routes[$method])) 
        {

            $proteger = $this->proteger != null ? $this->proteger : $this->routes[$method]["proteger"];
            if ($proteger == EnumProtect::Private) 
            {
                $this->auth->Proteger();
            }

            foreach ($this->routes[$method] as $routeUrl => $target) {
                // Use named subpatterns in the regular expression pattern to capture each parameter value separately
                //if($routeUrl == null) $routeUrl = "index";
                $pattern = preg_replace('/\/:([^\/]+)/', '/(?P<$1>[^/]+)', $routeUrl);
              
                $ex = explode("?", $url);
                $url = $ex[0];
                // print_r( $url );

                if (preg_match('#^' . $pattern . '$#', $url, $matches))
                {
                    
                    // Pass the captured parameter values as named arguments to the target function
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY); // Only keep named subpattern matches
                    
                    // print_r( $params );
                    $_REQUEST += $params;
                    // print_r( $_REQUEST );

                    // exit;

                    call_user_func_array($target, $params);
                    return;
                }
            }
        }
        throw new Exception('Route not found');
    }
}
