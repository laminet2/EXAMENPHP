<?php namespace App\Model;
    use App\Config\Model;
    class DetailProdModel extends Model{
        private int $qte;
        private int $id;
        private int $articleVenteID;
		
        private int $productionID;
        
        public function __construct(){
            parent::__construct();
            $this->table="detailprod";
        }
        
    
	/**
	 * @return int
	 */
	public function getArticleVenteID(): int {
		return $this->articleVenteID;
	}
	
	/**
	 * @param int $articleVenteID 
	 * @return self
	 */
	public function setArticleVenteID(int $articleVenteID): self {
		$this->articleVenteID = $articleVenteID;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getProductionID(): int {
		return $this->productionID;
	}
	
	/**
	 * @param int $productionID 
	 * @return self
	 */
	public function setProductionID(int $productionID): self {
		$this->productionID = $productionID;
		return $this;
	}
	public function setQte($qte){
		$this->qte=$qte;
	}
	public function getQte(){
		return $this->qte;
	}
	public function insert():int{
        //$sql="select * from categorie where id=$id" ;Jamais
        $sql="INSERT INTO $this->table (`id`, `qte`,`articleVenteID`,`productionID`) VALUES (NULL,:qte,:articleVenteID,:productionID)";//Requete preparee
        //prepare ==> requete avec parametres
        $stm= self::$dataBase->prepare($sql);
        $stm->execute(["qte" => $this->qte,"articleVenteID" => $this->articleVenteID,"productionID"=> $this->productionID]);
        return  $stm->rowCount() ;
     }
}