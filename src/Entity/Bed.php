<?php

namespace App\Entity;



abstract class Bed 
{
	private $slots;

	public function __construct(int $number_slots) 
	{
		$this->slots = $number_slots;
	}

	public function getSlots() : int
	{
		return $this->slots;
	}
}
