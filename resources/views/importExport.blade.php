@extends('voyager::master')
@section('content')
	<div class="container">
		<a href="{{ URL::to('admin/downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
		<a href="{{ URL::to('admin/downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
	</div>
@endsection