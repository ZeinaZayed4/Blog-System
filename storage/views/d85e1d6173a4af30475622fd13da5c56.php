<?php
    
    $category = db_find('users', request('id'));
    redirect_if(empty($category), aurl('users'));
    
    db_delete('users', request('id'));
    
    redirect(aurl('users'));