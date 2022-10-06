<?php

namespace IlBronza\ChartJs;

use IlBronza\ChartJs\Traits\ChartJsAxisTrait;
use IlBronza\ChartJs\Traits\ChartJsBackgroundColorTrait;
use IlBronza\ChartJs\Traits\ChartJsDatasetsTrait;
use IlBronza\ChartJs\Traits\ChartJsGettersTrait;
use IlBronza\ChartJs\Traits\ChartJsLabelsTrait;

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

	public $xScaleName;
	public $maxX;

	public $yScaleName;
	public $maxY;

	public $pieBackgroundColor;

	public function __construct()
	{
		$this->datasets = collect();

		$this->initializeLabels();
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

	public function setXScaleName(string $xScaleName)
	{
		$this->xScaleName = $xScaleName;
	}

	public function setYScaleName(string $yScaleName)
	{
		$this->yScaleName = $yScaleName;
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