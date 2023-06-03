<?php
    namespace Models;

use Services\DatabaseService;

    class User {
        private $table = 'user';
        /**
         * I would add getters and setters here where I would sanitize the data that is comming in.
         */
        public ?int $id              = null;
        public string $email         = '';
        public string $password      = '';

        public function createUser() {
            $connection = DatabaseService::getDatabaseConnection();

            $statement = $connection->prepare("INSERT INTO ? VALUES (?, ?)");
            $statement->bind_param("sss", $this->table, $this->email, $this->password);
            $statement->execute();
            // Old query
            // mysqli_query($connection, "INSERT INTO $this->table SET email = '$this->email', password =
            // '$this->password'");

            $user_id = mysqli_insert_id($connection);
            $this->id = $user_id;
            return $this;
        }

    }
