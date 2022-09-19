<canvas id="{{ $chart->getId() }}" style="width: 100%; height: '300px';"></canvas>
<script>
const ctx{{ $chart->getId() }} = document.getElementById('{{ $chart->getId() }}').getContext('2d');
const myChart{{ $chart->getId() }} = new Chart(ctx{{ $chart->getId() }}, {


type: '{{ $chart->getType() }}',
data: {
    labels: {!! $chart->getLabels() !!},
    datasets: [
@foreach($chart->getDatasets() as $dataset)
    {
      label: '{{ $dataset->getLabel() }}',
      backgroundColor: '{{ $dataset->getBackgroundColor() }}',
      data: [@foreach($dataset->getData() as $data) 
      {x: '{{ $data->getX() }}',      y: {{ $data->getY() ?? "false" }} } @if(! $loop->last),
      @endif @endforeach],
      },
    @endforeach

    ],
},
options: {
  scales: {
    y: {
      beginAtZero: true,
      min: null,
      max: null,
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
      max: null,
      {{-- type: 'linear', --}}
      reverse: false,
      title: {
        display: true,
        text: '{{ $chart->GetXScaleName() }}'
      }
    }
  }
} 
});
</script>
