<?php

namespace App\Entity;

use App\Entity\Bed;


class BunkBed extends Bed 
{
	
	public function __construct()
	{
		parent::__construct(2);
	}
}
