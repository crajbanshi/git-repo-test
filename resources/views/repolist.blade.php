
@extends('template')

{{$count = 1}}

@section('content')

<div class="container">


<div class="row">
	<div class="col-md-12 text-center">
		<br/>
		<h1>Search Dynamic Autocomplete using Bootstrap Typeahead JS</h1>	
			<input placeholder="Search..." class="typeahead form-control" style="margin:0px auto;width:300px;" type="text">
	</div>
</div>

<div class="row">

{{ $result->links() }}
</div>

	<table class="table table-bordered">
	<thead>
		<tr>
		<th>
				#
			</th>
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
		</thead>
		<tbody id="repobody">
		@foreach ($result as $data)
		<tr>
			<td>
			{{ $count++ }}
			</td>
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
	</tbody>
	</table>
    
</div>

{{ $result->links() }}


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
	
	function getPosts(page) {
    $.ajax({
        url : page,
		data:{ajax:1},
        dataType: 'json',
    }).done(function (data) {
        //console.log(data.data);
       renderRepoTable(data)
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
}

console.log($('.pagination').children('li').children('a'));

$('.pagination').children('li:first-child').remove();
$('.pagination').children('li:last-child').remove();

$('.pagination').children('li.active').children('span').replaceWith( '<a href="repo/ajaxrepo?page=1">1</a>' );

$('.pagination').children('li').children('a').click(function(e){
	e.preventDefault();
	console.log( "this.prop('href')" , $(this).prop('href') );
	console.log( "this.attr('href')", $(this).attr('href') );
	getPosts( $(this).prop('href') );
	$('.pagination').children('li').removeClass('active');
	 $(this).closest('li').addClass('active');
});


function renderRepoTable(data){
	var tbody = $('#repobody');
	var page = ((data.page -1) * 10)+1;
	tbody.html('');
	console.log('val => ', page);
	
	$.each(data.data.data, function(index, val){
		
		
		var html = '<tr><td>'
			+ page++
			+ '</td><td>'
			+ val['repoid']
			+ '</td><td>'
			+ val['rempname']
			+ '</td><td>'
			+ val['private']
			+ '</td><td>'
			+ val['description']
			+ '</td><td>'
			+ 'URL: <a href="' + val['url'] +'">' + val['url'] 
			+'</a><br/>Html URL: <a href="' + val['html_url'] +'">' + val['html_url']
			+'</a><br/>Clone url: <a href="'
			+ val['clone_url'] +'">' + val['clone_url'] 
			+'</a><br/>git url : <a href="' 
			+ val['git_url'] +'">' + val['git_url'] +'</a>'
			+ '</td></tr>';
			
			tbody.append(html);
	});
	
	
}
</script>


@endsection