<?php

namespace App\Api;

use Core\Application;
use Core\Helper;

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class Api
{
    public function showUsers()
    {
        if (isset($_GET) && !empty($_GET)) {
            $item = [];
            $user = Application::$app->database->select("*", "users")->where(['id'], ['='], [$_GET['id']])->data;
            if ($user) {
                $item = [
                    "id" => $user['id'],
                    "email" => $user['email'],
                    "user_name" => $user['user_name'],
                    "last_name" => $user['lastname'],
                    "phone_number" => $user['phone_number'],
                    "national_id_card" => $user['National_id_card']
                ];
                http_response_code(200);
                echo json_encode($item);
            } else {
                http_response_code(404);
                echo json_encode([
                    "message" => "item not found"
                ]);
            }
        } else {
            $items['items'] = [];
            $users = Application::$app->database->select("*", "users")->data;
            foreach ($users as $user) {
                $itemUsers = [
                    "id" => $user['id'],
                    "email" => $user['email'],
                    "user_name" => $user['user_name'],
                    "last_name" => $user['lastname'],
                    "phone_number" => $user['phone_number'],
                    "national_id_card" => $user['National_id_card']
                ];
                array_push($items['items'], $itemUsers);
            }
            http_response_code(200);
            echo json_encode($items);
        }
    }
    public function createUser()
    {
        $data = json_decode(file_get_contents("php://input"));
        $dataArray = (array) $data;
        if (!empty($data->user_name) && !empty($data->lastname) && !empty($data->email) && !empty($data->phone_number) && !empty($data->national_id_card)) {
            $create = Application::$app->database->insert("users", array_keys($dataArray), array_values($dataArray));
            if ($create) {
                http_response_code(201);
                echo json_encode([
                    "message" => "Item was created.",
                ]);
            } else {
                http_response_code(503);
                echo json_encode([
                    "message" => "Unable to create item."
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                "message" => "Unable to create item. Data is incomplete.",
            ]);
        }
    }
    public function updateUser()
    {
        $data = json_decode(file_get_contents("php://input"));
        $dataArray = (array) $data;
        if (!empty($data->user_name) && !empty($data->lastname) && !empty($data->email) && !empty($data->phone_number) && !empty($data->national_id_card)) {
            $update = Application::$app->database->update("users", array_keys($dataArray), array_values($dataArray),$_GET['id']);
            if ($update) {
                http_response_code(200);
                echo json_encode([
                    "message" => "Item was updated.",
                ]);
            } else {
                http_response_code(503);
                echo json_encode([
                    "message" => "Unable to update item."
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                "message" => "Unable to update item. Data is incomplete.",
            ]);
        }
    }
}
