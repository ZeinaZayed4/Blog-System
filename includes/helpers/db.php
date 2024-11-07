<?php
    
    /**
     * Insert data into database
     * @param string $table
     * @param array $data
     * @return array as assoc
     */
    if(!function_exists('db_create')) {
        function db_create(string $table, array $data) : array
        {
            $sql = 'INSERT INTO '.$table;
            $columns = '';
            $values = '';
            foreach ($data as $key => $value) {
                $columns .= $key . ',';
                $values .= "'" . $value . "',";
            }
            
            $columns = rtrim($columns, ',');
            $values = rtrim($values, ',');
            $sql .= "(".$columns.") VALUES (" . $values . ")";
            
            mysqli_query($GLOBALS['conn'], $sql);
            $id = mysqli_insert_id($GLOBALS['conn']);
            $first = mysqli_query($GLOBALS['conn'],'SELECT * FROM '. $table . ' WHERE id ='.$id);
            $data =  mysqli_fetch_assoc($first);
            $GLOBALS['query'] = $first;
            
            return $data;
        }
    }
    /**
     * Updating data in database
     * @param string $table
     * @param array $data
     * @param int $id
     * @return array as assoc
     */
    
    if (!function_exists('db_update')) {
        function db_update(string $table, array $data, int $id): array
        {
            $sql = 'UPDATE ' . $table . ' SET ';
            $column_value = '';
            
            foreach ($data as $key => $value) {
                $column_value .= $key . " = '" . mysqli_real_escape_string($GLOBALS['conn'], $value) . "', "; // Using comma
            }
            
            $column_value = rtrim($column_value, ", ");
            $sql .= $column_value . ' WHERE id = ' . (int)$id;
            
            mysqli_query($GLOBALS['conn'], $sql);
            $first = mysqli_query($GLOBALS['conn'], 'SELECT * FROM ' . $table . ' WHERE id =' . (int)$id);
            $data = mysqli_fetch_assoc($first);
            $GLOBALS['query'] = $first;
            
            return $data;
        }
    }
    
    /**
     * Delete data from database
     * @param string $table
     * @param int $id
     */
    
    if (!function_exists('db_delete')) {
        function db_delete(string $table, int $id) : mixed
        {
            $query = mysqli_query($GLOBALS['conn'], 'DELETE FROM '. $table . ' WHERE id = ' . $id);
            $GLOBALS['query'] = $query;
            return $query;
        }
    }
    
    /**
     * Fetch single row data from database
     * @param string $table
     * @param int $id
     */
    
    if (!function_exists('db_find')) {
        function db_find(string $table, int $id) : mixed
        {
            $query = mysqli_query($GLOBALS['conn'], 'SELECT * FROM '. $table . ' WHERE id = ' . $id);
            $GLOBALS['query'] = $query;
            $result = mysqli_fetch_assoc($query);
            return $result;
        }
    }
    
    if(!function_exists('db_first')) {
        /**
         * @param string $table
         * @param string $query_str
         * @param string $select
         * @return mixed
         */
        function db_first(string $table, string $query_str, string $select='*'): mixed
        {
            $query = mysqli_query($GLOBALS['conn'], "SELECT ".$select." FROM ".$table." ".$query_str);
            $result = mysqli_fetch_assoc($query);
            $GLOBALS['query'] = $query;
            return $result;
        }
    }
    
    
    /**
     * Search for multiple rows data from database
     * @param string $table
     * @param int $id
     */
    
    if (!function_exists('db_get')) {
        function db_get(string $table, string $query_str) : mixed
        {
            $query = mysqli_query($GLOBALS['conn'], 'SELECT * FROM '. $table . " " . $query_str);
            $num = mysqli_num_rows($query);
            $GLOBALS['query'] = $query;
            
            return [
                'query' => $query,
                'num' => $num
            ];
        }
    }
    
    /**
     * Search for multiple and pagination rows data from database
     * @param string $table
     * @param int $id
     * @param string $query_str
     * @param int $limit
     * @return array
     */
    if (!function_exists('render_paginate')) {
        function render_paginate(int $total_pages, array $appends = []): string
        {
            $request_str = '';
            if (!empty($appends) && count($appends) > 0) {
                foreach ($appends as $key => $value) {
                    $request_str .= $key . '=' . $value . '&';
                }
            }
            $request_str .= 'page=';
            $html =  '<ul class="pagination justify-content-center" dir="ltr">';
            $p_disabled = empty(request('page')) || request('page') == 1 ? 'disabled' : '';
            
            $p_number = !empty(request('page')) && request('page') > 0 && is_numeric(request('page'))
            && request('page') <= $total_pages ? request('page') - 1 : 1;
            $html .= '<li class="page-item">
                      <a class="page-link '. $p_disabled . '" href="?'.$request_str. $p_number .'" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                      </li>';
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = (!empty(request('page')) && request('page') == $i) || ( $i == 1 && empty(request('page'))) ? 'active' : '';
                $html  .= '<li class="page-item '.$active.'"><a href="?'.$request_str.$i.'" class="page-link">'.$i.'</a></li>';
            }
            $n_disabled = !empty(request('page')) && request('page') == $total_pages ? 'disabled' : '';
            $n_number = !empty(request('page')) && request('page') > 0 && is_numeric(request('page'))
            && request('page') < $total_pages ? request('page') + 1 : 1;
            $html .='<li class="page-item '.$n_disabled.'">
                    <a class="page-link" href="?'.$request_str . $n_number. '" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>';
            return $total_pages > 0 ? $html : '';
        }
    }
    
    if (!function_exists('db_paginate')) {
        /**
         * @param string $table
         * @param string $query_str
         * @param int $limit
         * @param string $order_by
         * @param string $select
         * @param array|null $appends
         * @return array
         */
        function db_paginate(string $table, string $query_str, int $limit = 1, string $order_by = 'asc', string $select = '*', array $appends = null) : array
        {
            if (is_null($appends)) {
                $appends = [];
            }
            
            if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
                $current_page = $_GET['page'] - 1;
            } else {
                $current_page = 0;
            }
            
            $query_count = mysqli_query($GLOBALS['conn'], "SELECT COUNT(" . $table. ".id) from ". $table. " ". $query_str);
            $count = mysqli_fetch_row($query_count);
            $total_records = $count[0];
            
            $start = $current_page * $limit;
            $total_pages = ceil( $total_records / $limit);
            if ($current_page >= $total_pages) {
                $start = $total_pages + 1;
            }
//            var_dump($total_pages);

//            var_dump($count[0]);
            $query = mysqli_query($GLOBALS['conn'],
                "SELECT ". $select . " FROM ". $table . " ". $query_str. " order by " . $table. ".id " . $order_by. " LIMIT {$start}, {$limit}");
            $num = mysqli_num_rows($query);
            $GLOBALS['query'] = $query;
            
            return [
                'query' => $query,
                'num' => $num,
                'render' => render_paginate($total_pages, $appends),
                'current_page' => $current_page,
                'limit' => $limit
            ];
        }
    }
    
    
    