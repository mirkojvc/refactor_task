<?php
    namespace Services;

    /**
     * Handles requests and request data
     */
    class RequestService {
        private static $service_name = 'RequestService';

        /**
         * Handles the request for user registration, gets the data from the request and sends it to the appropriate function
         * Throws an exception if something goes wrong
         *
         * @return string Json string response
         */
        public static function userRegisterRequest(): string {
            try {
                $email = $_REQUEST['email'];
                $password = $_REQUEST['password'];
                $password2 = $_REQUEST['password2'];

                $user_id = UserService::registerUser($email, $password, $password2);

                return RequestService::createRequestBody(true, ['user_id' => $user_id]);
            } catch(\Exception $e) {
                return self::createRequestBody(false, ['error' => $e->getMessage(), 'code' => $e->getCode()]);
            }
        }

        /**
         * Create a body for all requests
         *
         * @param boolean $success
         * @param array $data
         * @return string
         */
        public static function createRequestBody(bool $success, array $data): string {
            $body = [];
            $body['success'] = $success;
            foreach($data as $key => $value) {
                $body[$key] = $value;
            }

            return json_encode($body);
        }
    }
?>