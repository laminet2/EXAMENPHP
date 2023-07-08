<?php 
namespace App\Model;
class ArticleVenteModel extends ArticleModel{
    private $prixVente;
	private $montantVente;
    public function __construct(){
        parent::__construct();
        $this->type="articleVente";
    }

	/**
	 * @return mixed
	 */
	public function getPrixVente() {
		return $this->prixVente;
	}
	
	/**
	 * @param mixed $prixVente 
	 * @return self
	 */
	public function setPrixVente($prixVente): self {
		$this->prixVente = $prixVente;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMontantVente() {
		return $this->montantVente;
	}
	
	/**
	 * @param mixed $montantVente 
	 * @return self
	 */
	public function setMontantVente($montantVente): self {
		$this->montantVente = $montantVente;
		return $this;
	}
}