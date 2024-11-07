<?php
    
    $data = validation(
        [
            'name' => 'required|string',
            'icon' => 'required|image',
            'description' => 'required',
        ],
        [
            'name' => trans('cat.name'),
            'icon' => trans('cat.icon'),
            'description' => trans('cat.desc'),
        ]);
    
    $file_info = file_ext($data['icon']);
    $data['icon'] = store_file($data['icon'],'categories/' . $file_info['hash_name']);
    
    db_create('categories', $data);
    session_flash('old');
    session('success', trans('admin.success_message'));
    redirect(aurl('categories'));