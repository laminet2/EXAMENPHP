<?php 
namespace App\Model;
use App\config\Model;
class ApprovissionementModel extends Model{
    private int $id;
    private  $date;
    private $montant;
    private bool $payer;

    #private string ArticleConfModel();
    public function __construct(){
        parent::__construct();
        $this->table="approvissionement";
        $detailAppro=new DetailApproModel;
         $articleModel=new ArticleConfModel ;
         
         #$date = new DateTimeImmutable();
         #$this->date=$date->format('Y-m-d');
    
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
}