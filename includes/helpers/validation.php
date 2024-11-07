<?php
    
    if (!function_exists('validation')) {
        function validation(array $attributes, array $trans = null, $http_header = 'redirect', $back = null)
        {
            $validations = [];
            $values = [];
            // Start loop to extract attributes
            foreach ($attributes as $attribute => $rules) {
                $value = request($attribute);
                $values[$attribute] = $value;
                $attribute_validate = [];
                $final_attr = $trans[$attribute] ?? $attribute;
                
                foreach (explode('|', $rules) as $rule) {
                    if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.email'));
                    } elseif ($rule == 'required' && ((empty($value)) || isset($value['tmp_name']) && empty($value['tmp_name']))) {
                        $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.required'));
                    } elseif ($rule == 'integer' && !filter_var((int) $value, FILTER_VALIDATE_INT)){
                        $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.integer'));
                    } elseif ($rule == 'string' && !is_string($value)) {
                        $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.address'));
                    } elseif ($rule == 'numeric' && !is_numeric($value)) {
                        $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.numeric'));
                    } elseif ($rule == 'image' && (!empty($value['tmp_name']) && getimagesize($value['tmp_name']) === false)) {
                        $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.image'));
                    }elseif (preg_match('/^in:/i', $rule)) {
                        $ex_rule = explode(':' , $rule);
                        // 0 => in
                        // 1 => user, adimn
                        if (isset($ex_rule[1])) {
                            $ex_in = explode(',' , $ex_rule[1]);
                            if (!empty($ex_in) && is_array($ex_in) && !in_array($value, $ex_in)) {
                                $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.in'));
                            }
                        }
                    } elseif (preg_match('/^unique:/i', $rule)) {
                        $ex_rule = explode(':' , $rule);
                        if (count($ex_rule) > 1 && isset($ex_rule[1])) {
                            $get_unique_info = explode(',', $ex_rule[1]);
                            $table = $get_unique_info[0];
                            $column = $get_unique_info[1] ?? $attribute;
                        }
                        if (isset($get_unique_info[2])) {
                            $sql = "WHERE " . $column . "='" . $value . "' and id!='" . $get_unique_info[2] . "'";
                        } else {
                            $sql = "WHERE " . $column . "='" . $value . "'";
                        }
                        $check_unique_db = db_first($table, $sql);
                        if (!empty($check_unique_db)) {
                            $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.unique'));
                        }
                        var_dump($rule);
                    } elseif (preg_match('/^exists:/i', $rule)) {
                        $ex_rule = explode(':' , $rule);
                        if (count($ex_rule) > 1 && isset($ex_rule[1])) {
                            $get_exists_info = explode(',', $ex_rule[1]);
                            $table = $get_exists_info[0];
                            $column = $get_exists_info[1] ?? $attribute;
                        }
                        if (isset($get_exists_info[2])) {
                            $sql = "WHERE " . $column . "='" . $value . "'";
                        } else {
                            $sql = "WHERE id='" . $value . "'";
                        }
                        $check_exists_db = db_first($table, $sql);
                        if (empty($check_exists_db)) {
                            $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.exists'));
                        }
                        var_dump($rule);
                    }
                }
                // Bind attributes
                if (!empty($attribute_validate) && is_array($attribute_validate) && count($attribute_validate) > 0) {
                    $validations[$attribute] = $attribute_validate;
                }
            } // End loop to extract attributes
            
            if (count($validations) > 0) {
                if ($http_header == 'redirect') {
                    session('errors', json_encode($validations));
                    session('old', json_encode($values));
                    if (!is_null($back)) {
                        redirect($back);
                    } else {
                        back();
                    }
                } elseif ($http_header == 'api') {
                    response($validations, 422);
                }
            } else {
                return $values;
            }
        }
    }
    
    
    if (!function_exists('any_errors')) {
        function any_errors($offset = null)
        {
            $array = json_decode(session('errors'), true);
            if (isset($array[$offset])) {
                $text = $array[$offset];
                return $text ?? [];
            } elseif (!empty($array) && count($array) > 0) {
                return $array;
            } else {
                return [];
            }
        }
    }
    
    if (!function_exists('all_errors')) {
        function all_errors(): array
        {
            $all_errors = [];
            foreach (any_errors() as $errors) {
                foreach ($errors as $error) {
                    $all_errors[] = $error;
                }
            }
            return $all_errors;
        }
    }
    
    if (!function_exists('get_error')) {
        function get_error($offset): ?string
        {
            $error = '<ul>';
            foreach (any_errors($offset) as $error_string){
                if (is_string($error_string)) {
                    $error .= '<li>' . $error_string . '</li>';
                }
            }
            $error .= '</ul>';
            return !empty(any_errors($offset)) ? $error : null;
        }
    }
    
    if (!function_exists('end_errors')) {
        function end_errors(): void
        {
            session_flash('errors');
        }
    }
    
    if (!function_exists('old')) {
        function old($request)
        {
            $old_values = json_decode(session('old'), true);
            if (is_array($old_values) && !empty($old_values) && in_array($request, array_keys($old_values))) {
                return $old_values[$request];
            } else {
                return '';
            }
        }
    }