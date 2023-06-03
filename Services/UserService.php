<?php
namespace Services;

use LogService;
use Models\User;
use Services\ValidationService;
use Services\DatabaseService;
use Services\ExceptionService;

class UserService {
    private static $service_name = 'UserService';
    /**
     * Creates a user on sent parameters
     *
     * @param string $email
     * @param string $password
     * @return integer
     */
    public static function createUser(string $email, string $password): int {
        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $user = $user->createUser();
        return $user->id;
    }

    /**
     * Validates data and does the necessary steps to register a user
     *
     * @param string $email
     * @param string $password
     * @param string $password2
     * @return boolean
     */
    public static function registerUser(string $email, string $password, string $password2): bool {
        ValidationService::validateEmail($email);
        ValidationService::validatePassword($password);
        ValidationService::validatePassword($password2);
        if($password !== $password2) {
            $exception_key = 'PASSWORD_MISMATCH';
            ExceptionService::throwExceptionForKey($exception_key, self::$service_name);
        }

        $exists = self::userExists($email);
        if ($exists) {
            $exception_key = 'USER_EXISTS';
            ExceptionService::throwExceptionForKey($exception_key, self::$service_name);
        }

        $check_max_mind = ValidationService::checkMaxMind($email);
        if ($check_max_mind) {
            $exception_key = 'USER_SCAM';
            ExceptionService::throwExceptionForKey($exception_key, self::$service_name);
        }

        $user_id = self::createUser($email, $password);
        $type = 'welcome';
        EmailService::sendEmail($email, $type);
        $action = 'register';
        LogService::createUserLog($user_id, $action);
        $key = 'user_id';
        SessionService::setSession($key, $user_id);

        return $user_id;
    }

    /**
     * Checks if a user exists
     *
     *
     * Tought: Should it be here or in the model?
     * @param string $email
     * @return boolean
     */
    public static function userExists(string $email): bool {
        $connection = DatabaseService::getDatabaseConnection();
        $statement = $connection->prepare("SELECT * FROM user WHERE email = ?");
        $statement->bind_param("s", $email);
        $statement->execute();
        // $result = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email'");
        $result = $statement->get_result();
        return mysqli_num_rows($result) > 0;
    }
}
