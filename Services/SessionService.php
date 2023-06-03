<?php

namespace Services;

/**
 *
 * Primitive version of a session service
 */
class SessionService {
    private static $service_name = 'SessionService';

    /**
     * Sets a session key on given parameters
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public static function setSession(string $key, string $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Returns an ip address of a current user
     * This is the simplest way and no fallback is implemented, so there is a chance an ip address won't be provided or
     * that it will not be correct
     *
     * @return void
     */
    public static function getCurrentSessionIpAddress() {
        return $_SERVER['REMOTE_ADDR'];
    }
}
