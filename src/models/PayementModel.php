<?php 

namespace App\Model;

use App\config\Model;
class PayementModel extends Model{
    private int $id;
    private float $montant;
    private string $date;
    private int $venteID;

    public function __construct(){
        parent::__construct();
        $this->table="payement";
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
    /**
     * Get the value of venteID
     */ 
    public function getVenteID()
    {
        return $this->venteID;
    }

    /**
     * Set the value of venteID
     *
     * @return  self
     */ 
    public function setVenteID($venteID)
    {
        $this->venteID = $venteID;

        return $this;
    }
    public function insert(){
        $sql="INSERT INTO `payement` (`id`, `montant`, `date`, `venteID`) VALUES (NULL, :montant, :date, :venteID)";
        $stm= self::$dataBase->prepare($sql);
        $stm->execute([ 
                        "date" =>        $this->date,
                        "montant" =>     $this->montant,
                        "venteID"=>$this->venteID
                        ]);

    }
}