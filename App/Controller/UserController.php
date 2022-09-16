<?php

namespace App\Controller;

use Core\Application;
use Core\Helper;
use Core\Controller;
use Morilog\Jalali\Jalalian;
class UserController extends Controller
{
    public function reserveView($id)
    {
        $id = $id['routeParams']['id'];
        $this->is_user_login();
        // $hotel = Application::$app->database->selectWithQuery("SELECT * , (SELECT hotels.name FROM hotels WHERE hotels.id = popular_hotel.hotel_id) AS name, (SELECT cities.name FROM cities WHERE cities.id=hotels.city_id) as city FROM popular_hotel WHERE id = $id");
        $hotel = Application::$app->database->selectWithQuery("SELECT popular_hotel.*,hotels.name,cities.id as city_id,cities.name as city FROM popular_hotel INNER JOIN hotels ON popular_hotel.hotel_id=hotels.id INNER JOIN cities ON cities.id=hotels.city_id WHERE popular_hotel.id=$id");
        $user = Application::$app->database->select("*","users")->where(['email'],['='],[$_SESSION['email']])->data;
        $this->render("app.reserve",[$user,$hotel]);
    }
    private function is_user_login()
    {
        if(isset($_SESSION['email'])){
            return true;
    }else{
        Helper::redirect_to("/login");
        exit;
    }
}
    public function reserveStore()
    {
        date_default_timezone_set('Asia/Tehran');
        $values = ['created_at'=>Jalalian::now()->format('%Y-%m-%e %T'),'user_id'=>$_POST['user_id'],'city_id'=>$_POST['city_id']];
        $_POST = array_merge($_POST,$values);
        // Helper::dd($_POST);
        $reserve = Application::$app->database->insert("reserved",array_keys($_POST),array_values($_POST));
        if($reserve){
            Helper::redirect_to("/home");
        }
    }
}
