<?php

namespace IlBronza\ChartJs;

use Illuminate\Support\Str;

class Data
{
	public $x;
	public $y;

	public function setX(string $x)
	{
		$this->x = $x;
	}

	public function setY(string $y)
	{
		$this->y = $y;
	}

	public function getX()
	{
		return $this->x;
	}

	public function getY()
	{
		return $this->y;
	}

	static function createFromArray(array $parameters)
	{
		$data = new static;

		foreach($parameters as $name => $value)
			$data->$name = $value;

		if($x = ($parameters['x'] ?? false))
			$data->setX($x);

		if($y = ($parameters['y'] ?? false))
			$data->setY($y);

		return $data;
	}

	static function createFake(float $i)
	{
		$data = new static;

		$data->setX($i);
		$data->setX(Str::random(3));

		$data->setY($i + rand(0, 20));

		return $data;
	}
}