<?php
    namespace Services;

    /**
     * Sending emails and parsing data required for sending emails
     */
    class EmailService {
        private static $service_name = 'EmailService';
        private static $system_email = 'adm@kupujemprodajem.com';
        private static $emails = [
            'welcome' => [
                'subject' => 'Dobro došli',
                'message' => 'Dobro dosli na nas sajt. Potrebno je samo da potvrdite
                email adresu ...'
            ],
        ];

        /**
         * Sends an email with the required parameters
         *
         * @param string $to
         * @param string $type
         * @return boolean
         */
        public static function sendEmail(string $to, string $type): bool {
            if(!array_key_exists($type, self::$emails)) {
                $exception_key = 'EMAIL_TYPE';
                ExceptionService::throwExceptionForKey($exception_key, self::$service_name);
            }
            return mail($to, self::$emails[$type]['subject'], self::$emails[$type]['message'], self::$system_email);
        }
    }

