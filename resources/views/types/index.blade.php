@extends('default')

@section('content')

	

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>libelle</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($types as $type)

				<tr>
					<td>{{ $type->id }}</td>
					<td>{{ $type->libelle }}</td>

					<td>
						<div class="d-flex gap-2">
                            {!! Form::open(['method' => 'DELETE','route' => ['types.destroy', $type->id]]) !!}
                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
	<div class="d-flex justify-content-end mb-3"><a href="{{ route('types.create') }}" class="btn btn-primary">Creer</a></div>

@stop
