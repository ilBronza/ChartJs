<canvas id="{{ $chart->getId() }}" style="width: 100%; height: '300px';"></canvas>
<div class="uk-form-horizontal">

  <label class="uk-form-label" for="form-horizontal-select">@lang('chartjs::chartjs.chartType')</label>
  <div class="uk-form-controls">
  <select data-chartid="{{ $chart->getId() }}" class="charttype uk-select">
    @foreach(['line', 'pie', 'bar'] as $type)
    <option @if($type == $chart->getType()) selected @endif value="{{ $type }}">{{ $type }}</option>
    @endforeach
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

        @if($type = $dataset->getType())
        type: '{{ $type }}',
        @endif

        @if($yAxisId = $dataset->getYAxisId())
        yAxisID: '{{ $yAxisId }}',
        @endif
        },
      @endforeach

      ],
  },
  options: {
    @if($chart->hasAxis())
    scales: {
      @foreach($chart->getAxes() as $axis)
      {{ $axis->getName() }}: {
        
        beginAtZero: {{ $axis->getBeginAtZero() ? 'true' : 'false' }},
        
        min: {{ $axis->getMin() ?? 'null' }},
        max: {{ $axis->getMax() ?? 'null' }},

        @if($axis->getPosition())
        position: '{{ $axis->getPosition() }}',
        @endif

        @if($axis->getType())
        type: '{{ $axis->getType() }}',
        @endif

        reverse: {{ $axis->getReverse() ? 'true' : 'false' }},

        title: {
          display: {{ $axis->mustDisplayTitle() ? 'true' : 'false' }},
          text: '{{ $axis->getTitleText() }}'
        }
      },
      @endforeach
    }
    @endif
  }
};

window.ctx{{ $chart->getId() }} = document.getElementById('{{ $chart->getId() }}').getContext('2d');
window.myChart{{ $chart->getId() }} = new Chart(window.ctx{{ $chart->getId() }}, window.chartOptions{{ $chart->getId() }});
</script>
