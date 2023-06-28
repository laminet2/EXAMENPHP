<?php
namespace App\config;

abstract class Model{

protected string $table;
protected \PDO $dataBase;


public function __construct()
{
    try {
        $this->dataBase= new \PDO("mysql:host=localhost:3306;db_name=examenPhp","root","");
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
    $stm= $this->dataBase->prepare($sql);
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
    $stm= $this->dataBase->prepare($sql);
    $stm->execute(["x"=>$id]);
    return  $stm->rowCount() ;
 }

}
?>