@extends('default')

@section('content')

	

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>nom</th>
				<th>prenom</th>
				<th>age</th>
				<th>email</th>
				<th>niveauEtude</th>
				<th>sexe</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($candidats as $candidat)

				<tr>
					<td>{{ $candidat->id }}</td>
					<td>{{ $candidat->nom }}</td>
					<td>{{ $candidat->prenom }}</td>
					<td>{{ $candidat->age }}</td>
					<td>{{ $candidat->email }}</td>
					<td>{{ $candidat->niveauEtude }}</td>
					<td>{{ $candidat->sexe }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('candidats.show', [$candidat->id]) }}" class="btn btn-info">Vue</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['candidats.destroy', $candidat->id]]) !!}
                                {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('candidats.create') }}" class="btn btn-primary">Creer</a></div>

@stop
