<?php

namespace App\Controller;

use Core\Controller;
use Core\Application;
use Core\Helper;

class HomeController extends Controller{
    public function index()
    {
        $most_populars = Application::$app->database->selectWithQuery("SELECT popular_hotel.*,hotels.name as name,hotels.scare as scare,cities.name as city FROM popular_hotel INNER JOIN hotels ON hotels.id=popular_hotel.hotel_id INNER JOIN cities ON cities.id=popular_hotel.city_id");
        return $this->render("app.home",$most_populars);

    }
    public function createPopularHotel()
    {
        return $this->render("admin.popular-hotel.create");
    }
    public function store()
    {
        Application::$app->helper->saveimage($_FILES);
        $_POST['image'] = $_FILES['image']['tmp_name'];
        Application::$app->database->insert("popular_hotel",array_keys($_POST),array_values($_POST));
    }
}