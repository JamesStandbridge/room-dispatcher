<?php

namespace App\Entity;

use App\Entity\Bed;



class SimpleBed extends Bed 
{
	
	public function __construct()
	{
		parent::__construct(1);
	}
}
