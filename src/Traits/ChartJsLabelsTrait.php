<?php

namespace IlBronza\ChartJs\Traits;

trait ChartJsLabelsTrait
{
	public function initializeLabels()
	{
		$this->labels = collect();		
	}

	public function setLabels($labels)
	{
		$this->labels = $labels;
	}

	public function addLabel($label)
	{
		$this->labels->push($label);
	}

	public function getLabelsType() : string
	{
		return $this->labelsType;
	}

	public function setLabelsType(string $type)
	{
		$this->labelsType = $type;
	}

	public function hasAlphabeticalsLabels() : bool
	{
		return $this->getLabelsType() == 'alphabetical';		
	}

	public function hasNumericLabels() : bool
	{
		return $this->getLabelsType() == 'numeric';
	}

	public function hasAlphabeticalLabels() : bool
	{
		return $this->getLabelsType() == 'alphabetical';		
	}

	public function hasSortableLabels() : bool
	{
		if(is_bool($this->sortableLabel))
			return $this->sortableLabel;

		if($this->hasNumericLabels())
			return true;

		if($this->hasAlphabeticalsLabels())
			return true;

		return false;
	}

	public function hasNumericLabelsPrecision()
	{
		return !! $this->labelsPrecision;
	}

	public function getRoundMax(float $max)
	{
		if($max < 1)
			return $max;

		for($i = 1; $i < 10; $i ++)
			if($max < (pow(10, $i)))
				return ceil($max / pow(10, $i - 1)) * pow(10, $i - 1);

		throw new \Exception('Numero maggiore di ' . pow(10, $i));
	}

	private function getMaxNumericLabels()
	{
		$max = 0;

		foreach($this->getDatasets() as $dataset)
			if(($value = $dataset->getData()->max('x')) > $max)
				$max = $value;

		if(! $this->hasNumericLabelsPrecision())
			$max = $this->getRoundMax($max);

		return $max;
	}

	public function setAlphabeticalLabels()
	{
		$this->labels = collect();

		foreach($this->getDatasets() as $dataset)
			foreach($dataset->getData() as $data)
				$this->labels->push(
					$data->getX()
				);

		return $this->labels = $this->labels->unique()->sort(function($a, $b)
			{
				return strcasecmp($a, $b);
			})->values();
	}

	public function setTextualLabels()
	{
		$this->labels = collect();

		return $this->labels;
	}

	public function setNumericLabels()
	{
		throw new \Exception('cossa xe qua?');

		$this->initializeLabels();

		$max = $this->getMaxNumericLabels();

		$result = [];

		if($max <= 1)
			for($i = 0; $i < 10; $i++)
				$result[] = 0.1 * $i;

		elseif($max <= 10)
			for($i = 0; $i < 10; $i++)
				$result[] = $max / 10 * $i;

		else if($max < 100)
			for($i = 0; $i < $max; $i++)
				$result[] = $max / $max * $i;

		else
			for($i = 0; $i < 20; $i++)
				$result[] = $max / 20 * $i;

		return implode(", ", $result);
	}

	public function calculateLabels()
	{
		if($this->hasNumericLabels())
			return $this->setNumericLabels();

		if($this->hasAlphabeticalLabels())
			return $this->setAlphabeticalLabels();

		return $this->setTextualLabels();
	}

	public function getLabels()
	{
		if(! count($this->labels))
			return $this->calculateLabels();

		return $this->labels;
	}
}