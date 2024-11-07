<?php
    
    if (!function_exists('config')) {
        /**
         * Get the value of a configuration option
         * @param string $key
         * @return string|null
         */
        function config(string $key): ?string
        {
            $config = explode('.', $key);
            if (count($config) > 0) {
                $result = include base_path('config/' . $config[0] . ".php");
                return $result[$config[1]];
            }
            return null;
        }
    }
    
    if (!function_exists('base_path')) {
        /**
         * Get the base path for the application
         * @param string $path
         * @return string
         */
        function base_path(string $path): string
        {
            return getcwd() . '/../' . $path;
        }
    }
    
    if (!function_exists('public_path')) {
        /**
         * Get the public base path for the application
         * @param string $path
         * @return string
         */
        function public_path(string $path): string
        {
            return getcwd() . '/' . $path;
        }
    }
    
    if (!function_exists('public_')) {
        /**
         * Get the base path for the application
         * @return string
         */
        function public_(): string
        {
            return 'public';
        }
    }
    
    if (!function_exists('set_locale')) {
        function set_locale(string $lang = null): void
        {
            session('locale', $lang);
        }
    }


