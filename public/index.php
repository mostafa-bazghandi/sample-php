<?php

session_start();
require('../Core/Autoloader.php');
include('../Core/config.php');
include('../vendor/autoload.php');

use Core\Config;
use Core\Helper;
use Core\Application;
use Morilog\Jalali\Jalalian;
use Morilog\Jalali\CalendarUtils;
use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\UserController;
use App\Controller\AdminController;

$app = new Application();
$app->routing->get('/home',[HomeController::class,'index']);
$app->routing->get('/create-popular-hotel',[HomeController::class,'createPopularHotel']);
$app->routing->post('/store',[HomeController::class,'store']);
$app->routing->get('/login',[AuthController::class,'renderLogin']);
$app->routing->get('/register',[AuthController::class,'renderRegister']);
$app->routing->post('/register/store',[AuthController::class,'registerStore']);
$app->routing->post('/login/check',[AuthController::class,'checkLogin']);
$app->routing->get('/admin/home',[AdminController::class,'index']);
$app->routing->get('/logout',[AuthController::class,'logout']);
$app->routing->get('/admin/users',[AdminController::class,'rendreUsers']);
$app->routing->get('/reserve/{id}',[UserController::class,'reserveView']);
$app->routing->post('/reserve/store',[UserController::class,'reserveStore']);
$app->routing->get('/admin/reserved',[AdminController::class,'showReserved']);
$app->routing->get('/admin/hotels',[AdminController::class,'showHotels']);



$app->run();

