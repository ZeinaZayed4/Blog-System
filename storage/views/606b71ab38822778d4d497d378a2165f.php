<?php
    
    $data = validation(
        [
            'name' => 'required|string',
            'icon' => 'image',
            'description' => 'required',
        ],
        [
            'name' => trans('cat.name'),
            'icon' => trans('cat.icon'),
            'description' => trans('cat.desc'),
        ]);
    
    if (!empty($data['icon']['tmp_name'])) {
        $category = db_find('categories', request('id'));
        redirect_if(empty($category), aurl('categories'));
        delete_file($category['icon']);
        $file_info = file_ext($data['icon']);
        $data['icon'] = store_file($data['icon'], 'categories/' . $file_info['hash_name']);
    } else {
        unset($data['icon']);
    }

    db_update('categories', $data, request('id'));
    redirect(aurl('categories/edit?id='.request('id')));