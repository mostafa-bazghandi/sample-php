<?php

session_start();
require('../Core/Autoloader.php');
include('../Core/config.php');
include('../vendor/autoload.php');

use App\Api\Api;
use Core\Config;
use Core\Helper;
use App\Api\AuthApi;
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
$app->routing->get('/admin/hotels',[AdminController::class,'renderHotels']);
$app->routing->get('/admin/hotels/show',[AdminController::class,'showHotels']);
$app->routing->get('/admin/hotel/create',[AdminController::class,'createHotels']);
$app->routing->post('admin/hotel/store',[AdminController::class,'hotelStore']);
$app->routing->get('/admin/hotels/{id}',[AdminController::class,'showHotel']);
$app->routing->post('admin/hotel/edit/{id}',[AdminController::class,'editStore']);
$app->routing->get('/admin/reserved/user/{id}',[AdminController::class,'reseredUser']);
$app->routing->get('/admin/reserved/hotel',[AdminController::class,'hotelUsers']);
$app->routing->get('/admin/user/{id}',[AdminController::class,'showUser']);
$app->routing->get('/admin/cities',[AdminController::class,'showCities']);
$app->routing->get('/admin/add-popular',[AdminController::class,'addPopular']);
$app->routing->get('/admin/remove-popular',[AdminController::class,'removePopular']);
$app->routing->get('/admin/reserved-rooms',[AdminController::class,'reservedRooms']);
$app->routing->get('/admin/city/hotels/{id}',[AdminController::class,'showCityHotels']);
$app->routing->get('/api/show/users',[Api::class,'showUsers']);
$app->routing->get('/api/auth/login',[AuthApi::class,'loginApi']);
$app->routing->post('/api/create/user',[Api::class,'createUser']);
$app->routing->put('/api/update/user',[Api::class,'updateUser']);
$app->routing->post('/admin/remove/hotel',[AdminController::class,'removeHotel']);



$app->routing->post('/admin/search/reserved',[AdminController::class,'searchReserved']);
$app->routing->post('/admin/delete/hotel',[AdminController::class,'deleteHotel']);





$app->run();

