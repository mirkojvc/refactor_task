<?php
    namespace Services;

    /**
     * Service used to validate different kinds of data
     */
    class ValidationService {
        private static $service_name = 'ValidationService';
        /**
         * Regex string for email validation
         *
         * @var string
         */
        private static string $email_format_regex = '/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/';


        /**
         * Preporucena duzina sifre
         *
         * @var integer
         */
        private static int $password_length = 8;

        /**
         * Validation for emails with 2 checks, if the email string is not empty and
         * a regex check to validate if it is an email string
         *
         * @param string $email
         * @return bool
         */
        public static function validateEmail(string $email): bool {
            if (empty($email)) {
                $exception_key = 'EMAIL_REQUIRED';
                ExceptionService::throwExceptionForKey($exception_key, self::$service_name);
            }

            if (!preg_match(self::$email_format_regex,$email)) {
                $exception_key = 'EMAIL_FORMAT';
                ExceptionService::throwExceptionForKey($exception_key, self::$service_name);
            }

            return true;
        }

        /**
         * Validation of a password string.
         *
         * @param string $password
         * @return bool
         */
        public static function validatePassword(string $password): bool {
            if (empty($password) || mb_strlen($password) < self::$password_length) {
                $exception_key = 'PASSWORD_FORMAT';
                ExceptionService::throwExceptionForKey($exception_key, self::$service_name);
            }

            return true;
        }

        public static function checkMaxMind(string $email): bool {
            $max_mind = new MaxMindService();
            return $max_mind->checkEmail($email);
        }
    }
?>
