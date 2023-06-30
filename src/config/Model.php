<?php
namespace App\config;

abstract class Model{

protected string $table;
protected static \PDO $dataBase;


public function __construct()
{
    try {
        Self::$dataBase = new \PDO("mysql:host=localhost:3306;dbname=examenphp","root","");
    } catch (\Throwable $th) {
        //throw $th;

    }

}    

public function find():array{
    return $this->executeSelect("select * from $this->table" );
}
public function findBy(string $filtre,mixed $value):self{
    return  $this->executeSelect("select * from $this->table where $filtre=:x",["x"=>$value],true);
  }

public function executeSelect(string $sql,array $data=[],$single=false){
    //prepare ==> requete avec parametres
    

    
    $stm= self::$dataBase->prepare($sql);
    $stm->setFetchMode(\PDO::FETCH_CLASS,get_called_class());
    $stm->execute($data);
    
    if($single){
       return  $stm->fetch() ;
    }else{
       return $stm->fetchAll(\PDO::FETCH_CLASS,get_called_class()); 
    }

 }
 public function remove(int $id):int{
    //$sql="select * from categorie where id=$id" ;Jamais
    $sql="delete from $this->table where id=:x";//Requete preparee
    //prepare ==> requete avec parametres
    $stm= self::$dataBase->prepare($sql);
    $stm->execute(["x"=>$id]);
    return  $stm->rowCount() ;
 }

}
?>