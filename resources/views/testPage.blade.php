@extends('uikittemplate::app')
@section('content')


<div uk-grid>
	<div class="uk-width-large">
		<pre>
    		@include('chartjs::_singleChart')			
		</pre>
	</div>
	
	<div class="uk-width-expand">
    		@include('chartjs::_singleChart')
	</div>
</div>

@endsection