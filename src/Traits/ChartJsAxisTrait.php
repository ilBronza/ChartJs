<?php

namespace IlBronza\ChartJs\Traits;

use Illuminate\Support\Str;

trait ChartJsAxisTrait
{
	public function hasAxis()
	{
		if($this->getType() == 'line')
			return true;

		if($this->getType() == 'bar')
			return true;

		return false;
	}

	public function setMaxY(float $maxY)
	{
		$this->maxY = $maxY;
	}

	public function setMaxX(float $maxX)
	{
		$this->maxX = $maxX;
	}

	public function getMaxY() : ? float
	{
		return $this->maxY;
	}

	public function getMaxX() : ? float
	{
		return $this->maxX;
	}

	public function getMaxYString()
	{
		return $this->getMaxY() ?? 'null';
	}

	public function getMaxXString()
	{
		return $this->getMaxX() ?? 'null';
	}
}