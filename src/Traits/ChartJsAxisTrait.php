<?php

namespace IlBronza\ChartJs\Traits;

use IlBronza\ChartJs\Axis;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait ChartJsAxisTrait
{
	public function setAxisScaleName(Axis $axis, string $yScaleName)
	{
		$axis
			->setTitleText($yScaleName)
			->setTitleDisplay(true);
	}
	
	public function setXScaleName(string $scaleName)
	{
		$axis = $this->getDefaultXAxis();

		$this->setAxisScaleName($axis, $scaleName);
	}

	public function setYScaleName(string $scaleName)
	{
		$axis = $this->getDefaultYAxis();

		$this->setAxisScaleName($axis, $scaleName);
	}

	protected function addDefaultYAxes()
	{
		$this->addAxis(
			$this->createDefaultYAxes()
		);
	}

	protected function addDefaultXAxes()
	{
		$this->addAxis(
			$this->createDefaultXAxes()
		);
	}

	public function createYAxes(string $name = null) : Axis
	{
		$axis = new Axis();

		$axis->setPosition('left');
		$axis->setType('linear');

		if($name)
			$axis->setName('y' . $name);

		return $axis;
	}

	public function createDefaultYAxes() : Axis
	{
		return $this->createYAxes()
				->setName('y');
	}

	public function createDefaultXAxes() : Axis
	{
		$axis = new Axis();

		$axis->setName('x');

		return $axis;
	}

	public function getDefaultYAxis() : Axis
	{
		return $this->getAxes()->firstWhere('name', 'y');
	}

	public function getDefaultXAxis() : Axis
	{
		return $this->getAxes()->firstWhere('name', 'x');		
	}

	public function addAxis(Axis $axis)
	{
		$this->axes->push($axis);
	}

	public function initializeAxes()
	{
		$this->axes = collect();

		$this->addDefaultYAxes();
		$this->addDefaultXAxes();
	}

	public function hasAxis() : bool
	{
		return true;
		// if($this->getType() == 'line')
		// 	return true;

		// if($this->getType() == 'bar')
		// 	return true;

		// return false;
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

	public function getAxes() : Collection
	{
		return $this->axes;
	}
}