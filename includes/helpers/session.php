<?php
    
    if (!function_exists('session')) {
        /**
         * Get or set a session value
         * @param string $key
         * @param mixed|null $value
         * @return string
         */
        function session(string $key, mixed $value = null) : string
        {
            if (!is_null($value)) {
                $_SESSION[$key] = encrypt($value);
            }
            return isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
        }
    }
    
    if (!function_exists('session_has')) {
        /**
         * Check if a session key exists
         * @param string $key
         * @return bool
         */
        function session_has(string $key) : bool
        {
            return isset($_SESSION[$key]);
        }
    }
    
    if (!function_exists('session_flash')) {
        /**
         * Get or set a flash session value
         * @param string $key
         * @param mixed|null $value
         * @return mixed
         */
        function session_flash(string $key, mixed $value = null) : mixed
        {
            if (!is_null($value)) {
                $_SESSION[$key] = $value;
            }
            $session = isset($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
            session_forget($key);
            return $session;
        }
    }
    
    if (!function_exists('session_forget')) {
        /**
         * Forget a specific session key
         * @param string $key
         * @return void
         */
        function session_forget(string $key): void
        {
            if (isset($_SESSION[$key])) {
                $_SESSION[$key] = null;
            }
        }
    }
    
    if (!function_exists('session_delete_all')) {
        /**
         * Delete all session data
         * @return void
         */
        function session_delete_all(): void
        {
            session_destroy();
        }
    }
