<?php
    
    /**
     * Exception handling url pages
     */
    
    $GET_ROUTES = $routes['GET'] ?? [];
    if (!isset($_POST['_method']) && !is_null(segment()) && !in_array(segment(), array_column($GET_ROUTES, 'segment'))) {
        $storage_segment = str_replace('/'.public_().'/', '', segment());
        if (preg_match('/^storage/i', $storage_segment)) {
            storage($storage_segment);
        } else {
            http_response_code(404);
            view('404');
            exit();
        }
    }