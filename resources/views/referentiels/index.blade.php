@extends('default')

@section('content')

	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>libelle</th>
				<th>Validated</th>
				<th>horaire</th>
				<th>Type</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($referentiels as $referentiel)

				<tr>
					<td>{{ $referentiel->id }}</td>
					<td>{{ $referentiel->libelle }}</td>
					@if($referentiel->validated == 1)
						<td> Oui </td>
						@else
						<td> Non </td>
					@endif
					<td>{{ $referentiel->horaire }}</td>
					@foreach($types as $type)
					@if($type->id == $referentiel->type_id)
					<td>{{ $type->libelle}} </td>
					@endif
					@endforeach

					<td>
						<div class="d-flex gap-2">
                            {!! Form::open(['method' => 'DELETE','route' => ['referentiels.destroy', $referentiel->id]]) !!}
                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
	<div class="d-flex justify-content-end mb-3"><a href="{{ route('referentiels.create') }}" class="btn btn-primary">Creer</a></div>


@stop
