<?php namespace App\Model;
      use App\config\Model;

class VenteModel extends Model{

    private int $id;
    private float $montant;
    private int $qteTotale;
    private string $date;
    private string $observation;
    private bool $statut;
    private int $clientID;
    
    public function __construct(){
        parent::__construct();
        $this->table="vente"; 
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
     * Get the value of qteTotale
     */ 
    public function getQteTotale()
    {
        return $this->qteTotale;
    }

    /**
     * Set the value of qteTotale
     *
     * @return  self
     */ 
    public function setQteTotale($qteTotale)
    {
        $this->qteTotale = $qteTotale;

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
     * Get the value of observation
     */ 
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set the value of observation
     *
     * @return  self
     */ 
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of clientID
     */ 
    public function getClientID()
    {
        return $this->clientID;
    }

    /**
     * Set the value of clientID
     *
     * @return  self
     */ 
    public function setClientID($clientID)
    {
        $this->clientID = $clientID;

        return $this;
    }
}