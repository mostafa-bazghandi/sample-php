<?php

namespace App\Controller;

use Core\Application;
use Core\Controller;
use Core\Helper;
use Core\Request;

class AuthController extends Controller{
    public function renderLogin()
    {
        $this->render("auth.login");
    }
    public function renderRegister()
    {
        $this->render("auth.register");
    }
    public function checkLogin()
    {
        $user = $this->findUser($_POST['email'],$_POST['password']);
        if($user){
            if($user[0]['is_admin'] == 1){
                Helper::redirect_to("admin/home");
                session_regenerate_id();
                $_SESSION['admin'] = true;
                $_SESSION['user_id'] = $user[0]['id'];
                $_SESSION['name'] = $user[0]['name'];
                Helper::redirect_to("/admin/home");
            }else{
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                Helper::redirect_to("/home");
            }
        }else{
            Helper::redirectBack();
            Helper::message('login_error','ایمیل یا رمز عبور اشتباه می باشد');
        }
    }
    public function registerStore()
    {

        $this->validate();

    }
    protected function validate()
    {

        if(empty($_POST['user_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['last_name']) || empty($_POST['national_id_card']) || empty($_POST['phone_number'])){
            echo 2;
            exit;
        } elseif(strlen($_POST['password']) < 8){
            echo 3;
            exit;
        }elseif ($_POST['password'] != $_POST['confirm_password']) {
            echo 4;
            exit;
        }elseif($this->is_exist_email($_POST['email']) == false){
            echo 5;
            exit;
        }else{
            unset($_POST['confirm_password']);
            $_POST['password'] = $this->hash_password($_POST['password']);
            $register = Application::$app->database->insert("users",array_keys($_POST),array_values($_POST));
            if($register){
                echo true;
                exit;
            }else{
                echo false;
                exit;
            }
        }
    }
    protected function hash_password($password)
    {
        return password_hash($password,PASSWORD_DEFAULT);
    }
    protected function is_exist_email($email)
    {
        $user = Application::$app->database->select("*","users")->where(['email'],["="],[$email])->data;
        if($user){
            return false;
        }else{
            return true;
        }
    }
    public function findUser($email,$password)
    {
        $user = Application::$app->database->select("*","users")->where(["email"],["="],[$email])->data;
        if($user){
            $verify_password = password_verify($password,$user['password']);
            if($verify_password){
                return $user;
            }else{
                return false;
            }
        }else{
            Helper::message('login_error','هیچ اکانتی با این ایمیل یافت نشد');
            Helper::redirectBack();
            exit;
        }
        return Application::$app->database->select("*","users")->where(["email","password"],["=","="],[$email,$password])->data;
    }
    public function checkAdmin()
    {
        if(!isset($_SESSION['admin'])){
            Helper::redirect_to("/login");
            exit;
        }
    }
    public function logout()
    {
        unset($_SESSION['admin'],$_SESSION['user_id'],$_SESSION['name'] );
        session_destroy();
        Helper::redirect_to('/home');
        exit;
    }

}