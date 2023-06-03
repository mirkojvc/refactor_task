<?php
    namespace Models;
    use Services\DatabaseService;

    class Log {

        private $table = 'user_log';
        /**
         * I would add getters and setters here where I would sanitize the data that is comming in.
         */
        public ?int $id              = null;
        public string $action         = '';
        public string $user_id        = '';

        public function createUserLog() {
            $connection = DatabaseService::getDatabaseConnection();
            $statement = $connection->prepare("INSERT INTO ? `action` = ?, user_id =
            ?, log_time = NOW()");
            $statement->bind_param("sss", $this->table, $this->action, $this->user_id);
            $statement->execute();

            // old query
            // mysqli_query($connection, "INSERT INTO $this->table SET `action` = $this->action, user_id =
            // $this->user_id, log_time = NOW()");
            return $this;
        }

    }
