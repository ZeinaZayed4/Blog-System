<?php
    
    require_once __DIR__ . '/../includes/app.php';
    
//    if (in_array(request('lang'), ['ar', 'en'])) {
//        set_locale(request('lang'));
//    } else {
//        set_locale(config('lang.default')); // Set default language if none provided
//    }

//    var_dump(config('session.timeout'));
    
//    $data = db_create('users',
//        ['name'=>'Zeina',
//            'password' => '123456',
//            'email'=>'zeina@gmail.com'
//        ]);
//    var_dump($data);
    
//    db_update('users',
//        [
//            'name' => 'Zeina',
//            'password' => '123456',
//            'email' => 'zeina@gmail.com'
//        ], 1);

//    db_delete('users', 1);

//    db_find('users', 1);
    
//    db_first('users',  " WHERE email='zeina@gmail.com'");
    
//    $users = db_get('users', '');
//    if ($users['num'] > 0){
//        while ($row = mysqli_fetch_assoc($users['query'])) {
//            echo $row['name'] . '<br>';
//        }
//    }
    
//    $users = db_paginate('users', '', 1);
//    while ($row = mysqli_fetch_assoc($users['query'])) {
//        echo $row['email'] . '<br />';
//    }
//    echo $users['render'];
    
    // set data
//    session('test', 'Test data from function');
//    echo session('test');
    
//    session_forget('test');

//    send_mail(['zeinazayed088@gmail.com'], 'test message', 'content message');
    
    // File management in storage folder
//    symlink(base_path('storage/files'), public_path('storage'));
//    delete_file('storage/images/img.jpg'); // delete file
//    storage('storage/images/img.jpg'); // show or download file
//    store_file(from, to);
//    remove_folder('storage/images'); // remove folder or directory
    
    route_init();
    
    if (!empty($GLOBALS['query'])) {
        mysqli_free_result($GLOBALS['query']);
    }
    
    mysqli_close($GLOBALS['conn']);
//    ob_end_clean();
    ob_end_flush();
