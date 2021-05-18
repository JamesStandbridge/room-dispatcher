<?php 

namespace App\Entity;

use App\Entity\BunkBed;
use App\Entity\SimpleBed;


class Room 
{
	private $id;
	private $beds;
	private $members;

	public function __construct(string $id, int $number_bunk, int $number_simple) 
	{
		for($i = 0; $i < $number_bunk; $i++) {
			$this->beds[] = new BunkBed();
		}
		for($i = 0; $i < $number_simple; $i++) {
			$this->beds[] = new SimpleBed();
		}
		$this->members = [];
		$this->id = $id;
	}

	public function getId() : string
	{
		return $this->id;
	}

	public function getBeds() : array
	{
		return $this->beds;
	}

	public function addMember(string $name) : self
	{
		if(!$this->isFull()) 
			$this->members[] = $name;
		else 
			throw new \Exception("Room is full");
		return $this;
	}

	public function getMembers() : array
	{
		return $this->members;
	}

	public function isFull() : bool
	{
		return count($this->members) >= $this->countSlots();
	}

	public function countMembers() : int
	{
		return count($this->members);
	}

	public function countSlots() : int
	{
		$slots = 0;
		foreach($this->beds as $bed)
			$slots += $bed->getSlots();
		return $slots;
	}
}