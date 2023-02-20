@extends('default')

@section('content')

	

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>Nom</th>
				<th>Duree (mois)</th>
				<th>Description</th>
				<th>isStarted</th>
				<th>dateDebut</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($formations as $formation)

				<tr>
					<td>{{ $formation->id }}</td>
					<td>{{ $formation->nom }}</td>
					<td>{{ $formation->duree }}</td>
					<td>{{ $formation->description }}</td>
					@if($formation->isStarted == 1)
						<td> Oui </td>
					@else
						<td> Non </td>
					@endif
					<td>{{ $formation->dateDebut }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('formations.show', [$formation->id]) }}" class="btn btn-info">Vue</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['formations.destroy', $formation->id]]) !!}
                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
	<div class="d-flex justify-content-end mb-3"><a href="{{ route('formations.create') }}" class="btn btn-primary">Creer</a></div>

@stop
