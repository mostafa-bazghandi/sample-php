<?php

namespace Core;

class Helper
{
    public static function asset($url)
    {
        return Config::$BASE_PATH . '\public\\' . $url;
    }
    public function saveimage($image)
    {
        $targetFile = "../app/images";
        if (move_uploaded_file($image['image']['tmp_name'], $targetFile)) {
            return true;
        } else {
            echo " there was an error uploading your file.";
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


