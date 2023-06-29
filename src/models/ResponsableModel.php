<?php
namespace App\Model;
class ResponsableModel extends ActeurModel{
    private $role;
    private $login;
    private $motDePasse;
    private $salaire;

    public function __construct(){
        parent::__construct();
        $this->type="Responsable";
    }
    

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of salaire
     */ 
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * Set the value of salaire
     *
     * @return  self
     */ 
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;

        return $this;
    }

    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of motDePasse
     */ 
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Set the value of motDePasse
     *
     * @return  self
     */ 
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }
    public function  findUserByLoginAndPassword(string $login,string $password){
        return $this->executeSelect("select * from $this->table where login like :login and motDePasse like :password",
                              [
                               "login"=>$login,
                               "password"=>$password,  
                              ],true) ;
     }
}
?>