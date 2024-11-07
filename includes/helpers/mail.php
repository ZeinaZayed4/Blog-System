<?php

    if(!function_exists('send_mail')) {
        /**
         * send mail used to send email address to users
         * @param array<string> $mails
         * @param string $subject
         * @param string $message
         * @return bool
         */
        function send_mail(array $mails, string $subject, string $message): bool
        {
            if (config('mail.protocol') == 'smtp') {
                ini_set('SMTP', config('mail.smtp_domain'));
                ini_set('smtp_port', config('mail.smtp_port'));
            }
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html:charset=UTF8' . "\r\n";
            $headers .= 'From: ' . config('mail.FROM_ADDRESS') . "\r\n";
            return mail($mails[0], $subject, $message, $headers);
        }
    }
    
