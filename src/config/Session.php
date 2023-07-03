<?php 
namespace App\Config;

class Session{
    public static function start(){
        if(session_status()== PHP_SESSION_NONE){
            session_start();
        }
         
      }
    public static function set(string $key,$value){
        self::start();
        $_SESSION[$key]=$value;
    }
    public static function get(string $key){
        return $_SESSION[$key];
    }
    public static function isset(string $key){
        return isset($_SESSION[$key]);
    }
    public static function unset(string $key){
        unset($_SESSION[$key]);
    }
    public static function destroy(){
        session_unset();
        session_destroy();
    }
    public static function getRole(){
        if(Self::isset('user')){
            $user=self::get("user");
            #dd($user->getRole());
            return $user->getRole();
        }return null;
    }
}
?>