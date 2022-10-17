<?php

namespace App\Controller;

use Core\Application;
use Core\Config;
use Core\Controller;
use Core\Helper;
use Morilog\Jalali\Jalalian;

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
        $this->render("admin.index", $data);
    }
    public function rendreUsers()
    {
        // $number_reserved =$this->database->selectWithQuery("SELECT users.*,reserved.created_at,(SELECT count(*) FROM reserved WHERE reserved.user_id=users.id) as count FROM users INNER JOIN reserved ON reserved.user_id=users.id");
        // $users = $this->database->selectWithQuery("SELECT users.*,c.count FROM users JOIN (SELECT user_id,COUNT(reserved.id) as count FROM reserved GROUP BY reserved.user_id) as c ON c.user_id=users.id");
        $users = $this->database->selectWithQuery("SELECT (SELECT COUNT(reserved.id) FROM reserved WHERE reserved.user_id=users.id) as count,users.* FROM users");
        //  Helper::dd($users);
        $this->render("admin.users.users", $users);
    }
    public function showReserved()
    {
        if (isset($_GET['reservation_number'])) {
            $data = Application::$app->database->selectWithQuery("SELECT reserved.*,users.*,hotels.name as hotel,cities.name as city FROM reserved LEFT JOIN users ON users.id=reserved.user_id INNER JOIN hotels ON hotels.id=reserved.hotel_id INNER JOIN cities ON cities.id=reserved.city_id WHERE reserved.reservation_number=" . $_GET['reservation_number']);
        } else {
            $data = Application::$app->database->selectWithQuery("SELECT reserved.*,users.*,hotels.name as hotel,cities.name as city FROM reserved LEFT JOIN users ON users.id=reserved.user_id INNER JOIN hotels ON hotels.id=reserved.hotel_id INNER JOIN cities ON cities.id=reserved.city_id");
        }
        // Helper::dd($data);
        $this->render("admin.reserved", $data);
    }
    public function renderHotels()
    {
        $cities = Application::$app->database->selectWithQuery("SELECT * FROM cities");;
        $this->render("admin.hotels.index", $cities);
    }
    public function showHotels()
    {
        $data = [];
        $hotels = Application::$app->database->selectWithQuery("SELECT hotels.*,cities.name as city,cities.id as city_id FROM hotels INNER JOIN cities ON cities.id=hotels.city_id");
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

        $result = '';
        if (isset($_GET['city_id'])) {
            $city_id = $_GET["city_id"];
            $hotels = Application::$app->database->selectWithQuery("SELECT hotels.*,cities.name as city FROM hotels INNER JOIN cities ON cities.id=hotels.city_id WHERE city_id=$city_id");
        }
        foreach ($hotels as $hotel) {
            if (empty($data[$hotel['id']])) $data[$hotel['id']] = 0;
            if (empty($count_user[$hotel['id']])) $count_user[$hotel['id']] = 0;
            $result .= '
            <tr>
            <td>' . $hotel['id'] . '</td>
            <td>' . $hotel['name'] . '</td>
            <td>' . $hotel['city'] . '</td>
            <td><img src="..\assets\app\images\\' . $hotel['picture'] . '" width="65" height="90"></td>
            <td>' . $hotel['scare'] . '</td>
            <td class="text-center">' . $hotel['number_of_rooms']  . '</td>
            <td class="text-center">' . $data[$hotel['id']] . '</td>
            <td class="text-center"><a href="/admin/reserved/hotel?hotel=' . $hotel['id'] . '" class="text-decoration-none text-primary">' . $count_user[$hotel['id']] . '</a></td>
            <td>' . $hotel['phone'] . '</td>
            <td class="setting-hotels">
            <div class="button-hotels">
                            <div class="button-hotels-edit">
                                <a href="/admin/hotels/' . $hotel['id'] . '" class="btn btn-primary">
                                    <span><i class="fa fa-edit"></i></span>
                                    <p class="mt-1 mr-2">ویرایش</p>
                                </a>
                            </div>
                            <div class="button-hotels-trash">
                                <a href="" class="btn btn-danger delete1"  data-id=' . $hotel['id'] . '>
                                    <span><i class="fa fa-trash"></i></span>
                                    <p class="mt-1 mr-2">حذف</p>
                                </a>
                            </div>
                            <script>
                            $(".delete1").click(function(){
                                var el = this
            var deleteId = $(this).data("id")
                if (confirm("Do you really want to delete record?") == true)
                    {
                    $.ajax({
                        url: "/admin/remove/hotel",
                        method: "POST",
                        data: {
                            id: deleteId
                        },
                        success: function(response) {

                            if (response == true) {
                                location.reload()
                            } else {
                                alert("record not deleted")
                            }
                        }
                    })
                }

                            })
                            </script>
                            ';
            if ($hotel['popular'] == 0) {
                $result .= '<div class="button-hotels-add">
                                <a href="/admin/add-popular?hotel_id=' . $hotel['id'] . '" class="btn btn-info">
                                    <span><i class="fa fa-add"></i></span>
                                    <p class="mt-1 mr-2">اضافه به محبوب ترین ها</p>
                                </a>
                            </div>
                            </div>
                    </td>
                </tr>
                            ';
            } elseif ($hotel['popular'] == 1) {
                $result .= '
                                <div class="button-hotels-add">
                                    <a href="/admin/remove-popular?hotel_id=' . $hotel['id'] . '" class="btn btn-danger">
                                        <span><i class="fa fa-trash"></i></span>
                                        <p class="mt-1 mr-2">حذف از محبوب ترین ها</p>
                                    </a>
                                </div>
                                ';
            }
        }
        echo $result;
        exit;
        // Helper::dd($hotels);

        // Helper::dd(json_encode($hotels,JSON_UNESCAPED_UNICODE));
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
        $user = $this->database->select("*", "users")->where(['id'], ['='], [$id])->data;
        $this->render("admin.users.user", $user);
    }
    public function showCities()
    {
        $cities = $this->database->selectWithQuery("SELECT (SELECT COUNT(hotels.id) FROM hotels WHERE hotels.city_id=cities.id) as count,cities.* FROM cities");

        // Helper::dd($cities);
        $this->render("admin.cities.index", $cities);
    }
    public function showCityHotels($id)
    {
        $id = $id['id'];
        $hotels = $this->database->selectWithQuery("SELECT * FROM hotels WHERE city_id=$id");
        $this->render("admin.cities.hotels", $hotels);
    }
    public function hotelUsers()
    {
        $hotel = $_GET['hotel'];
        $user = $this->database->selectWithQuery("SELECT users.* FROM reserved RIGHT JOIN users ON reserved.user_id=users.id WHERE reserved.hotel_id=$hotel");
        $this->render('admin.users.hotelUsers', $user);
    }
    public function addPopular()
    {
        $hotel_id = $_GET['hotel_id'];
        $hotel = $this->database->select("city_id,price,picture", "hotels")->where(['id'], ['='], [$hotel_id])->data;
        date_default_timezone_set('Asia/Tehran');
        $hotel['created_at'] = Jalalian::now()->format("%Y-%m-%d %T");
        $hotel['updated_at'] = Jalalian::now()->format("%Y-%m-%d %T");
        $hotel['hotel_id'] = $hotel_id;
        $popular = $this->database->insert('popular_hotel', array_keys($hotel), array_values($hotel));
        if ($popular) {
            $this->database->update("hotels", ['popular'], ['1'], $hotel_id);
            Helper::redirect_to('/admin/hotels');
        }
    }
    public function removePopular()
    {
        $hotel_id = $_GET['hotel_id'];
        $this->database->delete("popular_hotel", "hotel_id", $hotel_id);
        $this->database->update("hotels", ['popular'], ['0'], $hotel_id);
        Helper::redirect_to('/admin/hotels');
    }
    public function reservedRooms()
    {
        $hotel_id = $_GET['hotel_id'];
        $hotel = $this->database->selectWithQuery("SELECT * FROM reserved RIGHT JOIN users ON users.id=reserved.user_id RIGHT JOIN cities ON cities.id=reserved.city_id WHERE hotel_id=1");
        Helper::dd($hotel);
        $this->render('admin.reserved.reserved-rooms');
    }
    public function searchReserved()
    {
        $return = '';
        if (isset($_POST['query']) && $_POST['query'] != '') {
            $query = $_POST['query'];
            $result = $this->database->selectWithQuery("SELECT reserved.*,hotels.name as hotel,users.*,cities.name as city FROM reserved RIGHT JOIN hotels ON hotels.id=reserved.hotel_id RIGHT JOIN users ON users.id=reserved.user_id INNER JOIN cities ON cities.id=reserved.city_id WHERE reserved.reservation_number=$query");
        } else {
            $result = Application::$app->database->selectWithQuery("SELECT reserved.*,users.*,hotels.name as hotel,cities.name as city FROM reserved LEFT JOIN users ON users.id=reserved.user_id INNER JOIN hotels ON hotels.id=reserved.hotel_id INNER JOIN cities ON cities.id=reserved.city_id");
        }
        if ($result) {
            foreach ($result as $re) {
                $return .= '
                    <tr>
                    <td>' . $re['id'] . '</td>
                    <td>' . $re['hotel'] . '</td>
                    <td>' . $re['city'] . '</td>
                    <td>' . $re['last_name'] . ' ' . $re['user_name'] . '</td>
                    <td>' . $re['reservation_number'] . '</td>
                    <td>' . $re['number_of_rooms'] . '</td>
                    <td>' . $re['number_of_nights'] . '</td>
                    <td>' . $re['price'] . '</td>
                    <td>' . $re['reservation_date'] . '</td>
                    <td>' . $re['created_at'] . '</td>

                    </tr>
                    ';
            }
            echo $return;
        } else {
            echo 'reserved not found';
        }
    }
    public function deleteHotel()
    {
        Helper::dd($_POST['id']);
    }
    public function removeHotel()
    {
        $id = $_POST['id'];
        $del = $this->database->delete("hotels", "id", $id);
        if ($del) {
            echo true;
            exit;
        } else {
            echo false;
            exit;
        }
    }
}
