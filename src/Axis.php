<?php

namespace IlBronza\ChartJs;

use IlBronza\ChartJs\ChartJs;
use Illuminate\Support\Collection;

class Axis
{
	public string $name;
	public bool $beginAtZero = true;
	public ?float $min = null;
	public ?float $max = null;

	public ?string $type = null;
	public ?string $position = null;

	public bool $reverse = false;

	public array $title = [
		'display' => true,
		'text' => ''
	];

	public ChartJs $chart;

	public function getName()
	{
		return $this->name;
	}

	public function getMin() : ? float
	{
		return $this->min;
	}

	public function getMax() : ? float
	{
		return $this->max;
	}

	public function getType() : ? string
	{
		return $this->type;
	}

	public function getPosition() : ? string
	{
		return $this->position;
	}

	public function getBeginAtZero() : bool
	{
		return $this->beginAtZero;
	}

	public function getReverse() : bool
	{
		return $this->reverse;
	}

	public function mustDisplayTitle() : bool
	{
		return $this->title['display'];
	}

	public function getTitleText() : string
	{
		return $this->title['text'];
	}


	public function setName(string $name) : static
	{
		$this->name = $name;

		return $this;
	}

	public function setType(string $type = null) : static
	{
		$this->type = $type;

		return $this;
	}

	public function setPosition(string $position) : static
	{
		$this->position = $position;

		return $this;
	}

	public function setTitleText(string $text) : static
	{
		$this->title['text'] = $text;

		return $this;
	}

	public function setTitleDisplay(bool $display) : static
	{
		$this->title['display'] = $display;

		return $this;		
	}
}