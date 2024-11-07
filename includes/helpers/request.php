<?php

    if (!function_exists('request')){
        /**
         * request to get value from $_GET or $_POST
         * @param string|null $request
         * @return mixed
         */
        function request(string $request = null): mixed
        {
            if (!empty($_FILES[$request])) {
                return $_FILES[$request];
            }
            return $_REQUEST[$request] ?? null;
        }
    }