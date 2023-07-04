<?php namespace App\Model;
      use App\config\Model;
class DetailVenteModel extends Model{
    private $id;
    private $qte;
    private  $prix;
    private $articleVenteID;
    private $veneID;

    public function __construct(){
        parent::__construct();
        $this->table="detailVenteModel";
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
     * Get the value of qte
     */ 
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Set the value of qte
     *
     * @return  self
     */ 
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of articleVenteID
     */ 
    public function getArticleVenteID()
    {
        return $this->articleVenteID;
    }

    /**
     * Set the value of articleVenteID
     *
     * @return  self
     */ 
    public function setArticleVenteID($articleVenteID)
    {
        $this->articleVenteID = $articleVenteID;

        return $this;
    }

    /**
     * Get the value of veneID
     */ 
    public function getVeneID()
    {
        return $this->veneID;
    }

    /**
     * Set the value of veneID
     *
     * @return  self
     */ 
    public function setVeneID($veneID)
    {
        $this->veneID = $veneID;

        return $this;
    }
}