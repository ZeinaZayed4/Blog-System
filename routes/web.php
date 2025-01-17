<?php
    
    include base_path('routes/admin.php');
    
    route_get('/', 'front.home');
    route_get('lang', 'controllers.set_language');
    route_post('upload', 'controllers.upload');
    
    route_get('news/archive', 'front.archive');
    route_get('category', 'front.categories.category');
    route_get('news', 'front.categories.news');
    route_post('add/comment', 'controllers.front.add_comment');
    