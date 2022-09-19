<?php

namespace IlBronza\ChartJs\Traits;

use IlBronza\ChartJs\Dataset;

trait InteractsWithChartTrait
{
	abstract function getDataset() : Dataset;
}