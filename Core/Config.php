<?php

namespace Core;


class Config{
    //database
    const DB_HOST = 'localhost';
    const DB_NAME = 'sample_php';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const SERVER_NAME = 'localhost:8080';
    //path
    public static $BASE_PATH;
    public function __construct()
    {
        self::$BASE_PATH = dirname(__DIR__);
        date_default_timezone_set('Asia/Tehran');
    }
//or $_SERVER['REQUEST_URI']
}

