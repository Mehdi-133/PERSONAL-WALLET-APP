<?php

namespace App\Core;

class handelErrors
{
    public static function register()
    {
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
    }

    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    public static function handleException($exception)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        error_log("Exception: " . $exception->getMessage() . " in " . $exception->getFile() . " on line " . $exception->getLine());

        $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";

        exit();
    }
}
