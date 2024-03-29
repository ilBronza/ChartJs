<?php

namespace IlBronza\ChartJs;

use IlBronza\ChartJs\Axis;
use IlBronza\ChartJs\ChartJs;
use IlBronza\ChartJs\Data;
use Illuminate\Support\Collection;

class Dataset
{
	public $label;
	public $data;
	public $chart;
	public ? string $type = null;
	public $backgroundColor;
	public ? Axis $yAxis = null;
	public $yAxisId;


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

	public function setLabel(string $label) : self
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

	public function setYAxis(Axis $axis)
	{
		$this->yAxis = $axis;
	}

	public function getYAxis() : ? Axis
	{
		return $this->yAxis;
	}

	public function setType(string $type = null)
	{
		$this->type = $type;
	}

	public function getType() : ? string
	{
		return $this->type;
	}

	// public function setYAxisId(string $yAxisId)
	// {
	// 	$this->yAxisId = $yAxisId;
	// }

	public function getYAxisId() : ? string
	{
		return $this->getYAxis()?->getName();
	}

	public function setBackgroundColor(string $backgroundColor)
	{
		$this->backgroundColor = $backgroundColor;
	}

	public function getAxisDataString() : string
	{
		return $this->getData()->map(function($item)
		{
			return [
				'x' => $item->getX(),
				'y' => $item->getY()
			];
		})->toJson();
	}

	public function getPieDataString() : string
	{
		return $this->getData()->map(function($item)
		{
			return $item->getY();
		})->toJson();
	}

	public function getDataString() : string
	{
		if($this->getChart()->hasAxis())
			return $this->getAxisDataString();

		return $this->getPieDataString();
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