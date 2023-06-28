<?php 
namespace App\Model;
class ClientModel extends ActeurModel{
    private string $observation;
    public function __construct(){
        parent::__construct();
        $this->type="Client";
    }
    
}
?>