<?php

namespace IlBronza\ChartJs\Traits;

use IlBronza\ChartJs\Dataset;

trait ChartJsDatasetsTrait
{
	public function addDataset(Dataset $dataset)
	{
		$dataset->setChart($this);

		$this->datasets->push($dataset);
	}

	public function getDatasets()
	{
		return $this->datasets;
	}
}