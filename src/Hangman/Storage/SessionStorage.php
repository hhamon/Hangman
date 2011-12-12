<?php

namespace Hangman\Storage;

class SessionStorage implements StorageInterface
{
    public function __construct($sessionName)
    {
        session_name($sessionName);
        session_start();
    }

    public function read($key)
    {
        return !empty($_SESSION[$key]) ? $_SESSION[$key] : array();
    }

    public function write($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}