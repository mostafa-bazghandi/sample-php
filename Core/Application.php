<?php

namespace Core;

use App\Api;
use App\Controller\AuthController;
use Core\Config;
use Core\Helper;
use Core\Request;
use Core\Routing;
use Core\Database;
use App\Api\Read;

class Application
{
    public AuthController $auth;
    public Routing $routing;
    public Request $request;
    public Config $config;
    public Helper $helper;
    public Database $database;
    // public Api $api;
    public static Application $app;
    public function __construct()
    {
        $this->auth = new AuthController();
        $this->database = new Database();
        $this->routing = new Routing();
        $this->request = new Request();
        $this->config = new Config();
        $this->helper = new Helper();
        self::$app = $this;
        // $this->api = new Api();
    }
    public function run()
    {
        $this->routing->check();
    }
}
