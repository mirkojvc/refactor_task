<?php

use Models\Log;

/**
 * Service for different kind of activity loging
 */
class LogService {
    private static $service_name = 'LogService';
    /**
     * Creates a log of user interaction
     *
     * @param integer $user_id
     * @param string $action
     * @return void
     */
    public static function createUserLog(int $user_id, string $action): void {
        $log = new Log();
        $log->user_id = $user_id;
        $log->action  = $action;

        $log->createUserLog();
    }
}
