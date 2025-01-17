<?php
    
    use JetBrains\PhpStorm\NoReturn;
    
    if (!function_exists('storage')) {
        #[NoReturn] function storage(string $path): void
        {
            if (file_exists($path)) {
                header('Content-Description: file from server');
                header('Content-Type: attachment; filename=' . basename($path));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($path));
                readfile($path);
            }
            exit;
        }
    }
    
    if (!function_exists('storage_url')) {
        function storage_url(string $path = null): string
        {
            return !empty($path) ? url('storage/' . $path) : '';
        }
    }
    
    if (!function_exists('delete_file')) {
        function delete_file(string $to_path): bool
        {
            $path = rtrim(config('files.storage_files_path'), '/') . '/' . ltrim($to_path, '/');
            if (file_exists($path)) {
                unlink($path);
                return true;
            }
            return false;
        }
    }
    
    if (!function_exists('remove_folder')) {
        /**
         * @param string $path
         * @return bool
         */
        function remove_folder(string $path): bool
        {
            if (is_dir($path)) {
                return rmdir($path);
            }
            return false;
        }
    }
    
    if (!function_exists('store_file')) {
        /**
         * @param array $from
         * @param string $to
         * @return bool|string
         */
        function store_file(array $from, string $to): bool|string
        {
            if (isset($from['tmp_name'])) {
                $to_path = '/' . ltrim($to, '/');
                $path = config('files.storage_files_path') . '/' . ltrim($to_path, '/');
                $ex_path = explode('/', $path);
                $end_file = end($ex_path);
                $check_path = str_replace($end_file, '', $path);
                if (!is_dir($check_path)) {
                    mkdir($check_path, 0777, true);
                }
                move_uploaded_file($from['tmp_name'], $path);
                return $to;
            }
            return false;
        }
    }
    
    if (!function_exists('file_ext')) {
        function file_ext(array $file_name): array
        {
            if (!empty($file_name['name'])) {
                $fext = explode('.', $file_name['name']);
                $file_ext = end($fext);
                $hash_name = md5(10) . rand(000, 999) . '.' . $file_ext;
                return [
                    'name' => $file_name['name'],
                    'hash_name' => $hash_name,
                    'ext' => $file_ext,
                ];
            } else {
                return [
                    'name' => '',
                    'hash_name' => '',
                    'ext' => '',
                ];
            }
        }
    }
