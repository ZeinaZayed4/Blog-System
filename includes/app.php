<?php
    ob_start();
    
    $helpers = ['bcrypt', 'request', 'routing', 'helper', 'AES', 'db', 'session', 'auth', 'mail', 'translation', 'api', 'validation', 'storage', 'view', 'media'];
    foreach ($helpers as $helper) {
        require __DIR__ . '/helpers/' . $helper . '.php';
    }
    
    /**
     * session save path
     * with set ini and start session
     */
    session_save_path(config('session.session_save_path'));
    ini_set('session.gc_probability', 1);
    session_start([
        'cookie_lifetime' => config('session.timeout'),
    ]);
    
    $conn = mysqli_connect(
        config('database.host'),
        config('database.username'),
        config('database.password'),
        config('database.database')
    );

    $query = '';
    
    if (!$conn) {
        die('Connection failed' . mysqli_connect_error());
    }
    
    require_once base_path('/routes/web.php');
    require_once base_path('/includes/exception_error.php');
    
    