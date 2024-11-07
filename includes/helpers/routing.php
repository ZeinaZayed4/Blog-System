<?php
    
    use JetBrains\PhpStorm\NoReturn;
    
    $routes = [];
    
    if (!function_exists('route_get')) {
        /**
         * define a route for HTTP GET request
         * @param string $segment
         * @param string|null $view
         * @return void
         */
        function route_get(string $segment, string $view = null): void
        {
            global $routes;
            $routes['GET'][] = [
                'view' => $view,
                'segment' => '/' . public_(). '/'. ltrim($segment, '/'),
            ];
        }
    }
    
    if (!function_exists('route_post')) {
        /**
         * define a route for HTTP POST request
         * @param string $segment
         * @param string|null $view
         * @return void
         */
        function route_post(string $segment, string $view = null): void
        {
            global $routes;
            $routes['POST'][] = [
                'view' => $view,
                'segment' => '/' . public_(). '/'. ltrim($segment, '/'),
            ];
        }
    }
    
    if (!function_exists('route_init')) {
        /**
         * initialize and process defined layouts
         * @return void
         */
        function route_init(): void
        {
            global $routes;
            
            $GET_ROUTES = $routes['GET'] ?? [];
            $POST_ROUTES = $routes['POST'] ?? [];
            
            if(!isset($_POST['_method'])) {
                foreach ($GET_ROUTES as $rget) {
                    if (segment() == $rget['segment']) {
                        view($rget['view']);
                    }
                }
            }
            
            if (isset($_POST) && isset($_POST['_method']) && count($_POST) > 0 && strtolower($_POST['_method']) == 'post') {
                foreach ($POST_ROUTES as $rpost) {
                    if (segment() == $rpost['segment']) {
                        view($rpost['view']);
                    }
                }
                
                if (!is_null(segment()) && !in_array(segment(), array_column($POST_ROUTES, 'segment'))) {
                    http_response_code(404);
                    view('404');
                    exit();
                }
            }
        }
    }
    
    if (!function_exists('redirect')) {
        /**
         * redirect to a specified path
         * @param $path
         * @return void
         */
        #[NoReturn] function redirect($path): void
        {
            $check_path = parse_url($path);
            if (isset($check_path['scheme']) && isset($check_path['host'])) {
                header('Location: ' . $path);
            } else {
                header('Location: ' . url($path));
            }
            exit();
        }
    }
    
    if (!function_exists('redirect_if')) {
        function redirect_if(bool $statement, string $url): void
        {
            if ($statement) {
                redirect($url);
            }
        }
    }
    
    if (!function_exists('back')) {
        /**
         * redirect to the previous page
         * @return void
         */
        #[NoReturn] function back(): void
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    
    if (!function_exists('url')) {
        /**
         * Generate a URL for a given segment
         * @param string $segment
         * @return string
         */
        function url(string $segment): string
        {
            $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
            $url .= $_SERVER['HTTP_HOST'] . '/php-anonymous';
            return $url . '/' . public_(). '/'. ltrim($segment, '/');
        }
    }
    
    if (!function_exists('url')) {
        /**
         * Generate a URL for a given segment
         * @param string $segment
         * @return string
         */
        function url(string $segment): string
        {
            $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
            $url .= $_SERVER['HTTP_HOST'] . '/php-anonymous';
            return $url . '/' . public_(). '/'. ltrim($segment, '/');
        }
    }
    
    if (!function_exists('aurl')) {
        /**
         * Generate an Admin URL for a given segment
         * @param string $segment
         * @return string
         */
        function aurl(string $segment): string
        {
            $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
            $url .= $_SERVER['HTTP_HOST'] . '/php-anonymous';
            return $url . '/' . public_(). '/'. ADMIN .'/' . ltrim($segment, '/');
        }
    }
    
    if (!function_exists('segment')) {
        /**
         * Get the current URL segment
         * @return string
         */
        function segment(): string
        {
            $basePath = '/php-anonymous';
            $segment = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
            $removeQueryParam = explode('?', ltrim($segment, '/'))[0];
            return !empty($segment) ? '/' . $removeQueryParam : '/';
        }
    }
