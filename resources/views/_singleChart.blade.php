<canvas id="{{ $chart->getId() }}" style="width: 100%; height: '300px';"></canvas>
<div class="uk-form-horizontal">

  <label class="uk-form-label" for="form-horizontal-select">@lang('chartjs::chartType')</label>
  <div class="uk-form-controls">
  <select data-chartid="{{ $chart->getId() }}" class="charttype uk-select">
    <option value="line">line</option>
    <option value="pie">pie</option>
    <option value="bar">bar</option>
  </select>
  </div>
</div>


<script>

window.pieChartOptions{{ $chart->getId() }} = {
  type: 'doughnut',
  data: {
  labels: {!! $chart->getPieLabels() !!},
  datasets: [
  @foreach($chart->getDatasets() as $dataset)
      {
        label: '{{ $dataset->getLabel() }}',
        backgroundColor: {!! $chart->getPieBackgroundColorString() !!},
        data: {!! $dataset->getPieDataString() !!},
      },
  @endforeach ]
    }
};

window.chartOptions{{ $chart->getId() }} = {
  type: '{{ $chart->getType() }}',
  data: {
      labels: {!! $chart->getLabels() !!},
      datasets: [
  @foreach($chart->getDatasets() as $dataset)
      {
        label: '{{ $dataset->getLabel() }}',
        backgroundColor: '{{ $dataset->getBackgroundColor() }}',
        data: {!! $dataset->getDataString() !!},
        },
      @endforeach

      ],
  },
  options: {
    @if($chart->hasAxis())
    scales: {
      y: {
        beginAtZero: true,
        min: null,
        max: {{ $chart->getMaxYString() }},
        type: 'linear',
        reverse: false,
        title: {
          display: true,
          text: '{{ $chart->GetYScaleName() }}'
        }
      },
      x: {
        beginAtZero: true,
        min: null,
        max: {{ $chart->getMaxXString() }},
        {{-- type: 'linear', --}}
        reverse: false,
        title: {
          display: true,
          text: '{{ $chart->GetXScaleName() }}'
        }
      }
    }
    @endif
  }
};

window.ctx{{ $chart->getId() }} = document.getElementById('{{ $chart->getId() }}').getContext('2d');
window.myChart{{ $chart->getId() }} = new Chart(window.ctx{{ $chart->getId() }}, window.chartOptions{{ $chart->getId() }});
</script>
