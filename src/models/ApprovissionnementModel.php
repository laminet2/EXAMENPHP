<?php 
namespace App\Model;
use App\config\Model;
class ApprovissionementModel extends Model{
    private int $id;
    private string $date;
    public function __construct(){
        parent::__construct();
        $this->table="approvissionement";
    
    }

	/**
	 * @return \DateTime
	 */
	public function getDate(): DateTime {
		return $this->date;
	}
	
	/**
	 * @param \DateTime $date 
	 * @return self
	 */
	public function setDate(DateTime $date): self {
		$this->date = $date;
		return $this;
	}
}