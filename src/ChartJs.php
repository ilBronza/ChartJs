<?php

namespace IlBronza\ChartJs;

use IlBronza\ChartJs\Traits\ChartJsAxisTrait;
use IlBronza\ChartJs\Traits\ChartJsBackgroundColorTrait;
use IlBronza\ChartJs\Traits\ChartJsDatasetsTrait;
use IlBronza\ChartJs\Traits\ChartJsGettersTrait;
use IlBronza\ChartJs\Traits\ChartJsLabelsTrait;
use Illuminate\Support\Collection;

class ChartJs
{
	use ChartJsGettersTrait;
	use ChartJsDatasetsTrait;
	use ChartJsLabelsTrait;

	use ChartJsAxisTrait;

	use ChartJsBackgroundColorTrait;

	public $id;

	public $type;
	public $datasets;

	//alphabetical, numeric
	public $labelsType = 'numeric';
	public $sortableLabel;
	public $labelsPrecision = false;
	public $labels;

	public Collection $axes;

	public $xScaleName;
	public $maxX;

	public $maxY;

	public $pieBackgroundColor;

	public function __construct()
	{
		$this->datasets = collect();

		$this->initializeLabels();
		$this->initializeAxes();
	}

	public function setType(string $type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}

	public function renderPage()
	{
		return view('chartjs::chart', ['chart' => $this]);
	}

	public function render()
	{
		return view('chartjs::_singleChart', ['chart' => $this]);
	}

	
	public function getXScaleName() : string
	{
		return $this->xScaleName;
	}

	public function getYScaleName() : string
	{
		return $this->yScaleName;
	}
}