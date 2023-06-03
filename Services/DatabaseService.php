<?php
    namespace Services;

use Exception;
use Services\RequestService;
    /**
     * Database managment service
     */
    class DatabaseService {
        private static $connection = null;
        private static $service_name = 'DatabaseService';

        /**
         * Connects do the database if no connection is established, returns the established connection when it is exists
         *
         * @return \mysqli
         */
        public static function getDatabaseConnection(): \mysqli {
            if(self::$connection !== null) {
                return self::$connection;
            }
            // I would get this data from some environent or other secret file it
            // wouldn't be hardcoded here
            $url        = "127.0.0.1";
            $user       = "my_user";
            $password   = "my_password";
            $db         = "my_db";
            $link = mysqli_connect($url, $user, $password, $db);
            if(!$link) {
                $exception_key = 'DB_ERROR';
                ExceptionService::throwExceptionForKey($exception_key, self::$service_name);
            }

            return $link;
        }

        // public static function createTriggers() {

        //     $statement = $connection->prepare("
        //         CREATE DEFINER=`?`@`?` TRIGGER IF NOT EXISTS ?
        //         AFTER SELECT, INSERT, UPDATE ON ? FOR EACH ROW
        //         UPDATE ;
        //     ");
        //     $statement->bind_param("sss", $this->table, $this->email, $this->password);
        //     $statement->execute();
        // }
    }
