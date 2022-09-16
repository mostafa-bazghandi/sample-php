<?php

namespace App\Controller;

use Core\Application;
use Core\Controller;
use Core\Helper;

class AdminController extends Controller{
    public $database;
    public function __construct()
    {
        $this->database = Application::$app->database;
    }
    public function index()
    {
        $this->render("admin.index");
    }
    public function rendreUsers()
    {
        $users = $this->database->select("*","users")->get();
        $number_reserved =$this->database->selectWithQuery("SELECT users.*,reserved.created_at,(SELECT count(*) FROM reserved WHERE reserved.user_id=users.id) as count FROM users INNER JOIN reserved ON reserved.user_id=users.id");

        $this->render("admin.users",$number_reserved);
    }
    public function showReserved()
    {
        $data = Application::$app->database->selectWithQuery("SELECT *,hotels.name as hotel FROM reserved LEFT JOIN users ON users.id=reserved.user_id INNER JOIN hotels ON hotels.id=reserved.hotel_id");
        $this->render("admin.reserved",$data);
    }
    public function showHotels()
    {
        $data = [];
        $hotels = Application::$app->database->selectWithQuery("SELECT hotels.*,cities.name as city FROM hotels INNER JOIN cities ON cities.id=hotels.city_id");
        $sum_reserved = Application::$app->database->selectWithQuery("SELECT hotel_id,SUM(reserved.number_of_rooms) as sum FROM reserved GROUP BY reserved.hotel_id");
        foreach($sum_reserved as $key=>$value){
            $data[$value['hotel_id']] = $value['sum'];
        }
        // $hotels = array_merge($hotels,$data);
        // Helper::dd($hotels);
        $this->render("admin.hotels",$hotels,$data);
    }
}