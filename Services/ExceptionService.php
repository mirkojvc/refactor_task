<?php
    namespace Services;

    class ExceptionService {

        private static $service_name = 'ExceptionService';
        /**
         * Keeps all the error messages and codes in one place.
         *
         * Code distribution strategy:
         * service number is the first three numbers and they are incremented with every service.
         * error number is the second three numbers and they are incremented with every exception
         * Eg. first service is database service the number is 001 and the first error has the number 001
         * so the full exception number is 001001
         *
         * @var array
         */
        public static $exceptions = [
            'DatabaseService' => [
                'DB_ERROR' => [
                    'message' => 'Error connecting to the database',
                    'code'    => '001001'
                ]
            ],
            'EmailService' => [
                'EMAIL_TYPE' => [
                    'message' => 'Email type doesn\'t exist',
                    'code'    => '002001'
                ]
            ],
            'ExceptionService' => [
                'SERVICE_NO_EXIST' => [
                    'message' => 'Service exceptions don\'t exist',
                    'code'    => '003001'
                ],
                'EXCEPTION_NO_EXIST' => [
                    'message' => 'Exception type doesn\'t exist',
                    'code'    => '003002'
                ],
            ],
            'LogService' => [

            ],
            'RequestService' => [

            ],
            'SessionService' => [

            ],
            'UserService' => [
                'PASSWORD_MISMATCH' => [
                    'message' => 'password_mismatch',
                    'code'    => '007001'
                ],
                'USER_EXISTS' => [
                    'message' => 'User with that email already exists',
                    'code'    => '007002'
                ],
                'USER_SCAM'    => [
                    'message' => 'User with that email is a potential scammer',
                    'code'    => '007003'
                ]

            ],
            'ValidationService' => [

                'EMAIL_REQUIRED' => [
                    'message' => 'email',
                    'code'    => '008001'
                ],

                'EMAIL_FORMAT' => [
                    'message' => 'email_format',
                    'code'    => '008002'
                ],

                'PASSWORD_FORMAT' => [
                    'message' => 'password',
                    'code'    => '008003'
                ],
            ],
        ];


        /**
         * Fetches the error message for requested key
         *
         * @param string $exception_key
         * @return string
         */
        public static function getExceptionMessage(string $exception_key, string $service): string {
            if (!array_key_exists($service, self::$exceptions)) {
                throw new \Exception('Service exceptions don\'t exist');
                self::throwExceptionForKey('EXCEPTION_NO_EXIST', self::$service_name);
            }

            if (!array_key_exists($exception_key, self::$exceptions[$service])) {
                throw new \Exception('Exception type doesn\'t exist');
                self::throwExceptionForKey('EXCEPTION_NO_EXIST', self::$service_name);
            }

            return self::$exceptions['DB_ERROR']['message'];
        }

        /**
         * Fetches the exception code for requested key
         *
         * @param string $exception_key
         * @return string
         */
        public static function getExceptionCode(string $exception_key, string $service): string {
            if (!array_key_exists($service, self::$exceptions)) {
                throw new \Exception('Service exceptions don\'t exist');
                self::throwExceptionForKey('EXCEPTION_NO_EXIST', self::$service_name);
            }

            if (!array_key_exists($exception_key, self::$exceptions[$service])) {
                throw new \Exception('Exception type doesn\'t exist');
                self::throwExceptionForKey('EXCEPTION_NO_EXIST', self::$service_name);
            }

            return self::$exceptions['DB_ERROR']['code'];
        }

        /**
         * Throws exception for the desired exception type
         *
         * @param string $exception_key
         * @param string $service
         * @return void
         */
        public static function throwExceptionForKey(string $exception_key, string $service = '') {
            $message = ExceptionService::getExceptionMessage($exception_key, $service);
            $code = ExceptionService::getExceptionCode($exception_key, $service);
            throw new \Exception($message, $code);
        }
    }