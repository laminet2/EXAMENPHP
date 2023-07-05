<?php 
namespace App\Model;
class ClientModel extends ActeurModel{
    private string $observation;
    public function __construct(){
        parent::__construct();
        $this->type="Client";
    }
    public function insertClient(){
        return $this->insert(["observation"=>$this->observation]);
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
}
?>