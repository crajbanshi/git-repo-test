
@extends('template')


@section('content')

<div class="container">


<div class="row">
	<div class="col-md-12 text-center">
		<br/>
		<h1>Search Dynamic Autocomplete using Bootstrap Typeahead JS</h1>	
			<input placeholder="Search..." class="typeahead form-control" style="margin:0px auto;width:300px;" type="text">
	</div>
</div>

<script type="text/javascript">

	$('input.typeahead').typeahead({
	    source:  function (query, process) {
        return $.get('/repo/search', { query: query }, function (data) {
        		console.log(data);
        		//data = $.parseJSON(data);
	            return process(data);
	        });
	    }
	});

</script>

	<table class="table table-bordered">
		<tr>
			<th>
				Repo Id
			</th>
			<th>
				Name
			</th>
			<th>
				private
			</th>
			<th>
				description
			</th>
			<th>
				git_url
			</th>
		</tr>
		@foreach ($result as $data)
		<tr>
			<td>
			{{ $data->repoid }}
			</td>
			<td>
			{{ $data->rempname }}
			</td>
			<td>
			{{ $data->private }}
			</td>
			<td>
			{{ $data->description }}
			</td>
			<td>
			URL: <a href="{{ $data->url }}">{{ $data->url }}</a>
			<br/>
			Html URL: <a href="{{ $data->html_url }}">{{ $data->html_url }}</a>
			<br/>
			Clone url: <a href="{{ $data->clone_url }}">{{ $data->clone_url }}</a>
			<br/>
			git url : <a href="{{ $data->git_url }}">{{ $data->git_url }}</a>
			
			</td>
		</tr>
        
    @endforeach
	</table>
    
</div>

{{ $result->links() }}




@endsection