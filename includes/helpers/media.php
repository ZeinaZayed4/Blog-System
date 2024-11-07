<?php
    
    if (!function_exists('image')) {
        function image($url): void
        {
            view('admin.actions.view_image', ['image' => $url]);
        }
    }
    
    if (!function_exists('delete_record')) {
        function delete_record($url): void
        {
            view('admin.actions.destroy_form', ['url' => $url]);
        }
    }
