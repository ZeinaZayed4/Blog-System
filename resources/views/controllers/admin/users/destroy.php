<?php
    
    $category = db_find('users', request('id'));
    redirect_if(empty($category), aurl('users'));
    
    db_delete('users', request('id'));
    session('success', trans('admin.deleted'));
    redirect(aurl('users'));