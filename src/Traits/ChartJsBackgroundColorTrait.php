<?php

namespace IlBronza\ChartJs\Traits;

trait ChartJsBackgroundColorTrait
{
	public function generateHexColor(int $loop = 0, int $divisor = 16)
	{
		$color = 'rgb(' . implode(",", [
			rand(0, (256 / $divisor) - 1) * $divisor,
			rand(0, (256 / $divisor) - 1) * $divisor,
			rand(0, (256 / $divisor) - 1) * $divisor
		]) . ')';

		if(in_array($color, $this->pieBackgroundColor ?? []))
		{
			if($loop < 10)
				return $this->generateHexColor($loop ++);

			$loop = 0;

			return $this->generateHexColor($loop, $divisor / 2);
		}

		return $color;
	}

	public function setPieBagroundColor(array $colors)
	{
		$this->pieBackgroundColor = json_encode($colors);
	}

	public function getPieBackgroundColorString() : string
	{
		if($this->pieBackgroundColor)
			return $this->pieBackgroundColor;

		$this->pieBackgroundColor = $this->getPieLabels()->map(function($item, $index)
		{
			return $this->generateHexColor();
		})->toJson();

		return $this->pieBackgroundColor;
	}
}