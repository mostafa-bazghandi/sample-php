<?php

namespace Core;

class Helper
{
    public static function asset($url)
    {
        return Config::$BASE_PATH . '\public\\' . $url;
    }
    public static function saveimage($image,$name = null)
    {
        $imageFileType = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
        $targetFile =Config::$BASE_PATH.'\public\assets\app\images\\';
        // Helper::dd(is_dir($targetFile));
        if($name){
            if (move_uploaded_file($image['tmp_name'], $targetFile.$name.'.'.$imageFileType)) {
                return true;
            } else {
                echo " there was an error uploading your file.";
                exit;
            }
        }else{
            if (move_uploaded_file($image['tmp_name'], $targetFile.$image['name'])) {
                return true;
            } else {
                echo " there was an error uploading your file.";
                exit;
            }
        }
    }
    public static function dd($value)
    {
        var_dump($value);
        die;
    }
    public static function redirectBack()
    {
        return header("Location: ".$_SERVER['HTTP_REFERER']);
    }
    public static function message($name,$value = null)
    {
        if($value === null){
            $message = $_SESSION["message"][$name] ?? "";
            return $message;
        }else{
            $_SESSION["message"][$name] = $value;
        }
    }
    public static function redirect_to($location)
    {
        return header("Location: ".$location);
    }

}


