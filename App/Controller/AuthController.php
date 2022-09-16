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
                $_SESSION['user_id'] = $user[0]['id'];
                $_SESSION['email'] = $user[0]['email'];
                Helper::redirect_to("/home");
            }
        }else{
            Helper::redirectBack();
            Helper::message('login_error','email or password is worng');
        }
    }
    public function registerStore()
    {
        $this->validate($_POST);

    }
    protected function validate($fields)
    {
        if(empty($fields['name']) || empty($fields['email']) || empty($fields['password']) || empty($fields['confirm-password'])){
            Helper::redirectBack();
            Helper::message('register_error','Please fill all inputs');
        } elseif(strlen($fields['password']) < 8){
            Helper::redirectBack();
            Helper::message('register_error','Password must be at least 8 characters long');
        }elseif ($fields['password'] != $fields['confirm-password']) {
            Helper::redirectBack();
            Helper::message('register_error','The confirm password does not match to password');
        }elseif($this->is_exist_email($fields['email']) == false){
            Helper::redirectBack();
            Helper::message('register_error','Email is already registered');
        }else{
            unset($fields['confirm-password']);
            $fields['password'] = $this->hash_password($fields['password']);
            $register = Application::$app->database->insert("users",array_keys($fields),array_values($fields));
            if($register){
                Helper::redirect_to("/login");
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
            $verify_password = password_verify($password,$user[0]['password']);
            if($verify_password){
                return $user;
            }else{
                return false;
            }
        }else{
            Helper::message('login_error','No account found with this email');
            Helper::redirectBack();
            exit;
        }
        // $password = password_verify($password);
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
        Helper::redirect_to('/login');
        exit;
    }

}