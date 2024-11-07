<?php
    
    $new = db_find('news', request('id'));
    redirect_if(empty($new), aurl('news'));
    if (!empty($new['image'])) {
        delete_file($new['image']);
    }
    
    db_delete('news', request('id'));
    
    redirect(aurl('news'));