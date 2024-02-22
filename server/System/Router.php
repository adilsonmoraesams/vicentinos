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
        $protect = EnumProtect::NoAuth
    ) {

        // if ($protect == EnumProtect::Private)
        // {           
        //     $this->auth->Proteger();
        // }
        $this->routes[$method][$url]["url"] = $target;
        $this->routes[$method][$url]["proteger"] = $protect;
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

        if (isset($this->routes[$method])) {

            // print_r($this->routes[$method]["proteger"]);

            // $protect = $this->proteger;
            // if (isset($this->routes[$method]["proteger"]) && 
            //     $this->routes[$method]["proteger"] != EnumProtect::NoAuth) {
            //     $protect = $this->routes[$method]["proteger"];
            // }

            // if ($protect == EnumProtect::Private) {
            //     // $this->auth->Proteger();
            // }

            // print_r($this->routes);
            // exit;

            foreach ($this->routes[$method] as $routeUrl => $target) {
                // Use named subpatterns in the regular expression pattern to capture each parameter value separately
                //if($routeUrl == null) $routeUrl = "index";
                $pattern = preg_replace('/\/:([^\/]+)/', '/(?P<$1>[^/]+)', $routeUrl);


                /************ AUTENTICAÇÃO ************/
                $protect = $this->proteger;
                if (isset($this->routes[$method][$url]["proteger"]) && 
                    $this->routes[$method][$url]["proteger"] != EnumProtect::NoAuth) {
                    $protect = $this->routes[$method][$url]["proteger"];
                }
 
                if ($protect == EnumProtect::Private) {
                    $this->auth->Proteger();
                }
                /************ FIM - AUTENTICAÇÃO **************/

                
                $ex = explode("?", $url);
                $url = $ex[0];

                if (preg_match('#^' . $pattern . '$#', $url, $matches)) {

                    // Pass the captured parameter values as named arguments to the target function
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY); // Only keep named subpattern matches

                    $_REQUEST += $params;
                    // print_r( $_REQUEST );

                    // exit;

                    call_user_func_array($target["url"], $params);
                    return;
                }
            }
        }
        throw new Exception('Route not found');
    }
}
