<?php 
    namespace App\Model;
    use App\config\Model;

class ProductionModel extends Model{
    private int $id;
    private $date;
    private string $observation;

    public function __construct(){
        parent::__construct();
        $this->table="production";
    }
    

	/**
	 * @return string
	 */
	public function getObservation(): string {
		return $this->observation;
	}
	
	/**
	 * @param string $observation 
	 * @return self
	 */
	public function setObservation(string $observation): self {
		$this->observation = $observation;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDate() {
		return $this->date;
	}
	
	/**
	 * @param mixed $date 
	 * @return self
	 */
	public function setDate($date): self {
		$this->date = $date;
		return $this;
	}
}
