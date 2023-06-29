<?php 
namespace App\Config;

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
public static function PC(){
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
public static function toArray(object $data):array{
       
        $json=json_encode($data,JSON_PRETTY_PRINT);
        return  json_decode($json,true);
  }

  public static function toObject(array $data){
    
        $json=json_encode($data);
        return  json_decode($json,false);
  }
}
?>