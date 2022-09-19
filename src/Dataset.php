<?php

namespace IlBronza\ChartJs;

use IlBronza\ChartJs\ChartJs;
use IlBronza\ChartJs\Data;
use Illuminate\Support\Collection;

class Dataset
{
	public $label;
	public $data;
	public $chart;
	public $backgroundColor;


	static $sampleColors = ['#00FFFF', '#7FFFD4', '#0000FF', '#8A2BE2', '#5F9EA0', '#7FFF00', '#FF7F50', '#6495ED', '#00BFFF', '#ADFF2F', '#FF00FF'];

	public function __construct()
	{
		$this->data = collect();
	}

	public function setChart(ChartJs $chart)
	{
		$this->chart = $chart;
	}

	public function getChart() : ChartJs
	{
		return $this->chart;
	}

	public function setLabel(string $label) : static
	{
		$this->label = $label;

		return $this;
	}

	public function getLabel() : ? string
	{
		return $this->label;
	}

	public function addData(Data $data)
	{
		$this->data->push($data);
	}

	public function sortDataByProperty(string $property = 'x')
	{
		$this->data = $this->data->sort(function($a, $b) use($property)
			{
				return strcasecmp($a->$property, $b->$property);
			})->values();
	}

	public function getData() : Collection
	{
		if($this->getChart()->hasSortableLabels())
			$this->sortDataByProperty('x');

		return $this->data;
	}

	public function getRandomColor()
	{
		return static::$sampleColors
			[array_rand(static::$sampleColors)]
		;
	}

	public function getBackgroundColor()
	{
		return $this->backgroundColor ?? $this->getRandomColor();
	}

	public function setBackgroundColor(string $backgroundColor)
	{
		$this->backgroundColor = $backgroundColor;
	}

	//RIMUOVERE
	static function createFake()
	{
		$dataset = new static;
		$dataset->setLabel('maranzone' . rand(0, 99999));

		for($i = 0; $i < 8; $i++)
			$dataset->addData(
				Data::createFake(rand(1, 24))
			);

		return $dataset;
	}
}