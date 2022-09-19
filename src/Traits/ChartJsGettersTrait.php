<?php

namespace IlBronza\ChartJs\Traits;

use Illuminate\Support\Str;

trait ChartJsGettersTrait
{
	public function getId()
	{
		if($this->id)
			return $this->id;

		$this->id = Str::random(8);

		return $this->getId();
	}
}