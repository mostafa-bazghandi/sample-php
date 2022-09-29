<?php

namespace App\Controller;

use Core\Application;
use Core\Config;
use Core\Controller;
use Core\Helper;

class AdminController extends Controller
{
    public $database;
    public function __construct()
    {
        $this->database = Application::$app->database;
    }
    public function index()
    {
        $data = $this->database->selectWithQuery('SELECT (SELECT COUNT(*) FROM users) as users,(SELECT COUNT(*) FROM hotels) as hotels,(SELECT COUNT(*) FROM cities) as cities,(SELECT COUNT(*) FROM reserved) as reserved');
        $this->render("admin.index",$data);
    }
    public function rendreUsers()
    {
        // $number_reserved =$this->database->selectWithQuery("SELECT users.*,reserved.created_at,(SELECT count(*) FROM reserved WHERE reserved.user_id=users.id) as count FROM users INNER JOIN reserved ON reserved.user_id=users.id");
        $users = $this->database->selectWithQuery("SELECT users.*,c.count FROM users JOIN (SELECT user_id,COUNT(reserved.id) as count FROM reserved GROUP BY reserved.user_id) as c ON c.user_id=users.id");
        // Helper::dd($users);
        $this->render("admin.users.users", $users);
    }
    public function showReserved()
    {
        $data = Application::$app->database->selectWithQuery("SELECT reserved.*,users.*,hotels.name as hotel,cities.name as city FROM reserved LEFT JOIN users ON users.id=reserved.user_id INNER JOIN hotels ON hotels.id=reserved.hotel_id INNER JOIN cities ON cities.id=reserved.city_id");
        // Helper::dd($data);
        $this->render("admin.reserved", $data);
    }
    public function showHotels()
    {
        $data = [];
        $hotels = Application::$app->database->selectWithQuery("SELECT hotels.*,cities.name as city FROM hotels INNER JOIN cities ON cities.id=hotels.city_id");
        $sum_reserved = Application::$app->database->selectWithQuery("SELECT hotel_id,SUM(reserved.number_of_rooms) as sum FROM reserved GROUP BY reserved.hotel_id");
        foreach ($sum_reserved as $key => $value) {
            $data[$value['hotel_id']] = $value['sum'];
        }
        // $hotels = array_merge($hotels,$data);
        // Helper::dd($hotels);
        $users_hotel = Application::$app->database->selectWithQuery("SELECT hotel_id,COUNT(user_id) as count_user FROM reserved GROUP BY hotel_id");
        $count_user = [];
        foreach ($users_hotel as $key => $value) {
            $count_user[$value['hotel_id']] = $value['count_user'];
        }
        $this->render("admin.hotels.index", [$hotels,$count_user], $data);
    }
    public function createHotels()
    {
        $city = $this->database->select("*", "cities")->data;
        $this->render("admin.hotels.create", $city);
    }
    public function hotelStore()
    {
        $_POST['picture'] = $_FILES['picture']['name'];
        Helper::saveimage($_FILES['picture']);
        $hotel = $this->database->insert("hotels", array_keys($_POST), array_values($_POST));
        if ($hotel) {
            Helper::redirect_to("/admin/hotels");
        }
    }
    public function showHotel($id)
    {
        $id = $id['id'];
        $hotel = $this->database->selectWithQuery("SELECT hotels.*,cities.name as city FROM hotels INNER JOIN cities ON cities.id=hotels.city_id WHERE hotels.id = $id");
        $this->render("admin.hotels.edit", $hotel);
    }
    public function editStore($id)
    {
        $id = $id['id'];
        $picture = $this->database->select("picture", "hotels")->where(['id'], ['='], [$id])->data;
        if (!empty($_FILES['picture']['tmp_name'])) {
            if (file_exists(Config::$BASE_PATH . '\public\assets\app\images\\' . $picture['picture'])) {
                unlink(Config::$BASE_PATH . '\public\assets\app\images\\' . $picture['picture']);
            }
            Helper::saveimage($_FILES['picture']);
            $_POST['picture'] = $_FILES['picture']['name'];
        }
        $this->database->update("hotels", array_keys($_POST), array_values($_POST), $id);
        Helper::redirect_to("/admin/hotels");
    }
    public function reseredUser($id)
    {
        $id = $id['id'];
        $reserved = $this->database->selectWithQuery("SELECT reserved.*,users.user_name as user_name,users.lastname as lastname,hotels.name as hotel,cities.name as city FROM reserved INNER JOIN hotels ON hotels.id=reserved.hotel_id INNER JOIN cities ON cities.id=reserved.city_id INNER JOIN users ON users.id=reserved.user_id WHERE reserved.user_id=$id");
        $this->render("admin.reserved.reserved", $reserved);
    }
    public function showUser($id)
    {
        $id = $id['id'];
        $user = $this->database->select("*","users")->where(['id'],['='],[$id])->data;
        $this->render("admin.users.user",$user);
    }
    public function showCities()
    {
        Helper::dd('ok');
        $cities = $this->database->selectWithQuery("SELECT cities.*,c.count FROM cities JOIN (SELECT city_id,COUNT(city_id) as count FROM hotels GROUP BY city_id) as c ON cities.id = c.city_id");
        // Helper::dd($cities);
        $this->render("admin.cities.index",$cities);
    }
    public function showCityHotels($id)
    {
        $id = $id['id'];
        $hotels = $this->database->selectWithQuery("SELECT * FROM hotels WHERE city_id=$id");
        $this->render("admin.cities.hotels",$hotels);
    }
    public function hotelUsers()
    {
        $hotel = $_GET['hotel'];
        $user = $this->database->selectWithQuery("SELECT users.* FROM reserved RIGHT JOIN users ON reserved.user_id=users.id WHERE reserved.hotel_id=$hotel");
        $this->render('admin.users.hotelUsers',$user);
    }
}
