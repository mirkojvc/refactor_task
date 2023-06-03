<?php
    namespace Services;

    class MaxMindService {
        private string $url = '';
        private string $secret = '';
        private string $key = '';

        public function __construct__() {
            // I would get the parameters from a config file it would't be hardcoded
            $this->url    = 'max_mind_url';
            $this->secret = 'secret';
            $this->key    = 'key';
        }

        /**
         * Creates a connection string to MaxMind
         *
         * @return string
         */
        private function connectMaxMind(): string {
            // Generating a connection url for the rest api (if it is a rest api) with the provided parameters (url, secret, key)
            return 'testurl.com';
        }

        /**
         * Checks if the email is on the max mind list
         *
         * @param string $email
         * @return boolean
         */
        public function checkEmail(string $email): bool {
            $ip_address = SessionService::getCurrentSessionIpAddress();
            $url = $this->connectMaxMind();
            $url .= 'checkEmail=' . $email;
            $url .= 'ipAddress=' . $ip_address;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);

            $json = json_decode($result);

            if (empty($json) || json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception(json_last_error());
            }
            return false;
        }
    }
