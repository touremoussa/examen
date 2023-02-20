@extends('default')

@section('content')

	{{ $candidat->id }}

	<div>
			<h3>Mes Candidatures</h3>
			<ul>
				@foreach ($candidat->formations as $formation)
					<li>{{ $formation->nom }}</li>
				@endforeach
			</ul>

			<h3>Candidater a une formation</h3>
			<form action="{{ route('candidats.storeFormation', [$candidat->id]) }}" method="post">
				@csrf
				<a>{{$candidat->id}}</a>
				<select name="formation_id">
					@foreach ($formatione as $formation)
						<option value="{{ $formation->id }}">{{ $formation->nom }}</option>
					@endforeach
				</select>
				<button class="btn btn-primary" type="submit">Postuler</button>
			</form>

	</div>

@stop