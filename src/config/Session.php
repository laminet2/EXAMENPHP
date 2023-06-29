<?php 
namespace App\Config;

class Session{
    public static function start(){
        if(session_status()== PHP_SESSION_NONE){
            session_start();
        }
         
      }
    public static function set(string $key,$value){
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
}
?>