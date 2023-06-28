<?php 
namespace App\Config;

class Validator{
    public array $errors=[];
    public static function validate(){
        return count(self::$errors)==0;
    } 
    public static function isVide($value,$key,$message="Champ Obligatoire"){
        if(empty($value)){
            self::$errors[$key]=$message;
            return true;
        }return false;
    }
    public static function isNumberPositif($value,$key,$message="La valeur doit être positif"){
        if(!self::isVide($value,$key) ){
            if(!is_numeric($value)||$value<0){
                self::$errors[$key]=$message;
                return false;
            }return true;

        }return false;
    }
    public static function isEmail($value,$key,$message="Email Invalide"){
        
            if(!self::isVide($value,$key)){
                if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                    self::$errors[$key]=$message;
                    return false;
                }return true;
    
            }return false;
        
        
    }
    public static function getErrors(){
        return self::$errors;
    }
    public static function addError($key,$message="Erreur !"){
        self::$errors[$key]=$message;
    }
}
?>