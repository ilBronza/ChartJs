import Chart from 'chart.js/auto';
window.Chart = Chart;

window.dgcharts = new Array();
window.configchart = new Array();

jQuery(document).ready(function()
{
	// Chart.scaleService.updateScaleDefaults('linear', {
	// 	ticks: {
	// 		min: 0
	// 	}
	// });

	var chartspeed = 500;

	$("body").on('change', '.chartselector', function() {
		changeChartType($(this).val(), $(this).data('target'));
	});

	$(".chartselector").each(function()
	{
		var that = this;
		setTimeout( function()
		{
			changeChartType($(that).val(), $(that).data('target'));
		}, chartspeed);

		chartspeed += 500;
	})
	
	function changeChartType(newType, target)
	{
		var ctx = document.getElementById(target).getContext("2d");

		// Remove the old chart and all its event handles
		if (window.dgcharts[target]) {
			window.dgcharts[target].destroy();
		}

		// Chart.js modifies the object you pass in. Pass a copy of the object so we can use the original object later
		var temp = jQuery.extend(true, {}, window.configchart[target]);
		temp.type = newType;
		window.dgcharts[target] = new Chart(ctx, temp);
	};

	for (var key in window.configchart)
	{
		var ctx = document.getElementById(key).getContext("2d");
		window.dgcharts[key] = new Chart(ctx, window.configchart[key]);
	}
});
