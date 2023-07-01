<?php 
namespace App\Config;
use DateTime;

class Help{
    public static function   dumpDie($data){
        self::dump($data);
        die;
}
public static function dump($data){
        echo "<pre>";
        var_dump($data);
        echo("</pre>");
}
public static function Print(){
    echo("COUCOU");
}
public static  function getVariableName($variable) {
    $variables = get_defined_vars();
    
    foreach ($variables as $name => $value) {
        if ($value === $variable) {
            return $name;
        }
    }
    
    return null;
}
public static function errorField(array $error,$field){
    if(array_key_exists($field,$error)) return "is-invalid"  ; 
}

public static function dateToString($date){

    $dateString = DateTime::createFromFormat('d-m-Y', $date);
    return $dateString->format('d-m-Y');
}
public static function stringToDate($dateString){

    $date = DateTime::createFromFormat('d-m-Y', $dateString);
    return $date;
}


}
?>