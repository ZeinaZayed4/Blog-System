<?php
    
    if (!function_exists('trans')) {
        /**
         * @param string|null $key
         * @return string
         */
        function trans(string $key = null): string
        {
            $trans = explode('.', $key);
            $locale = session_has('locale') ? session('locale') : (config('lang.default') ?? config('lang.fallback'));
            
            $path = config('lang.path') . '/' . $locale . '/' . $trans[0] . ".php";
            
            if (file_exists($path) && count($trans) > 1) {
                $translations = include $path;
                
                return $translations[$trans[1]] ?? $key;
            }
            
            return $key;
        }
    }
    
    if (!function_exists('set_locale')) {
        /**
         * @param string|null $lang
         * @return void
         */
        function set_locale(string $lang = null): void
        {
            session('locale', $lang);
        }
    }
    
    