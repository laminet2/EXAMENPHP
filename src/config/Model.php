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

public function find(array $data=null):array{
    $element="*";
    
    return $this->executeSelect("select $element from $this->table" );
}
public function findReturnArrayWithMySelecteur($data):array{
    $element="*";
    if($data!=null){
        $element=implode(",",$data);
    }
    return $this->executeSelectReturnArray("select $element from $this->table" );
}
public function findBy(string $filtre,mixed $value,$single=false){
    return  $this->executeSelect("select * from $this->table where $filtre=:x",["x"=>$value],$single);
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
 public function executeSelectReturnArray(string $sql,array $data=[],$single=false){
    //prepare ==> requete avec parametres

    $stm= self::$dataBase->prepare($sql);
    $stm->setFetchMode(\PDO::FETCH_ASSOC);
    $stm->execute($data);
    
    if($single){
       return  $stm->fetch() ;
    }else{
       return $stm->fetchAll(\PDO::FETCH_ASSOC); 
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

 public function updateOneAttributById($id,$filtre,$value):int{
    $sql="Update  $this->table set $filtre=:value where id=:Id ";
    $stm= self::$dataBase->prepare($sql);
    $stm->execute([
                   "Id"=>$id,
                    "value"=>$value
        ]);
    return  $stm->rowCount() ;
 }

}
?>