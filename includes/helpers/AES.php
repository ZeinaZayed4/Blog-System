<?php
    
    if(!function_exists('encrypt')) {
        /**
         * encrypt function to encrypt plain text
         * @param string $value
         * @return string
         */
        function encrypt(string $value): string
        {
            $cipher = config('session.encryption_mode');
            $key = config('session.encryption_key');
            $ivLen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivLen);
            $ciphertext_raw = openssl_encrypt($value, $cipher, $key, OPENSSL_RAW_DATA, $iv);
            $hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
            $ciphertext = base64_encode($iv.$hmac.$ciphertext_raw);
            return $ciphertext;
        }
    }
    
    if(!function_exists('decrypt')){
        /**
         * decrypt function to decrypt plain text
         * @param string $ciphertext
         * @return string
         */
        function decrypt(string $ciphertext): string
        {
            $cipher = config('session.encryption_mode');
            $key = config('session.encryption_key');
            $convert = base64_decode($ciphertext);
            $ivLen = openssl_cipher_iv_length($cipher);
            $iv = substr($convert, 0, $ivLen);
            $hmac = substr($convert, $ivLen, 32);
            $ciphertext_raw = substr($convert, $ivLen + 32);
            $original_text = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
            $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
            if (hash_equals($hmac, $calcmac)) {
                return $original_text;
            }
            return '';
        }
    }
